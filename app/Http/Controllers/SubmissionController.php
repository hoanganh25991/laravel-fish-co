<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Country;
use App\Device;
use App\Http\Requests;
use App\Image;
use App\Submission;
use App\SubmissionDeviceFormat;
use App\SubmissionImage;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;
use Validator;

class SubmissionController extends Controller{
    const WARNING = "sorry, we still not handle this situation";
    const STATUS_CODE = "statusCode";
    const STATUS_MSG = "statusMsg";
    const DATA = "data";

    const LIMIT = 7;

    use ApiResponse;

    public function create(Request $request){
        /** validate */
        $countryIdArray = implode(',', Country::lists("id")->toArray());
        $validator = Validator::make($request->all(), [
            "uuid" => "required",
            "contact_number" => "required",
            "image" => "required",
            "country_id" => "required|in:{$countryIdArray}",
            "campaign_id" => "required"
        ]);

        /** check validate */
        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray());
        }


        /**
         * contact number is IDENTIFIER
         * base on contact number, define candidate
         */
        $candidate = null;
        $candidate = Candidate::with("device")->where("contact_number", $request->get("contact_number"))->first();

        $device = null;
        $device = Device::with("candidate")->where("uuid", $request->get("uuid"))->first();
        /**
         * |0|1|
         * |0|1|
         */
        if(!$candidate){
            /** 0-0, new candidate, new device */
            if(!$device){
                $candidate = new Candidate($request->all());
                $candidate->save();

                $device = new Device($request->all());
                $device->uuid = $request->uuid;
                $device->candidate_id = $candidate->id;
                $device->save();
            }

            /** 0-1, no candidate, but device belongTo "someone" */
            /** many he submit wrong phone number|borrow phone */
            if($device){
                return $this->res($request->all(), "may wrong phone number | borrow phone", 422);
            }
        }

        if($candidate){
            /** 1-0, has candidate, no device base on uuid found */
            /** this is his new device */
            if(!$device){
                $device = new Device($request->all());
                $device->uuid = $request->get("uuid");
                $device->candidate_id = $candidate->id;
                $device->save();

                /**
                 * update candidate info (name)
                 */
                $candidate->fill($request->all());
                $candidate->save();
            }

            /** 1-1, has candidate, device found base on uuid */
            if($device){
                /** compare candidate_id & candidate->id */
                if($device->candidate->id != $candidate->id){
                    /**
                     * he borrow phone from some one
                     * NOT ALLOW
                     */
                    return $this->res($request->all(), "borrow phone", 422);
                }

                if($device->candidate->id == $candidate->id){
                    /** update info for device */
                    /** be careful with $request->all() by */
                    /** $request->get("device") */
                    /** at client device[] */
                    $device->fill($request->all());
                    $device->save();
                }
            }
        }

        /** $candidate, $device checked OK */
        
        /** Submission base on CampaignId */
        $campaignId = $request->get("campaign_id");
        /** submission with 24-hr */
        $latestSubmission = null;
        $latestSubmission = Submission::orderBy("created_at", "desc")->where("campaign_id", $campaignId)->where("candidate_id", $candidate->id)->first();

        if($latestSubmission){
            $createdAt = $latestSubmission->created_at;
            $delta = time() - $createdAt;
            if($delta < 24 * 60 * 60){
                new SubmissionDeviceFormat($latestSubmission);
                return $this->res($latestSubmission->toArray(), "only one submission in 24 hr", 422);
            }
        }
        /** move on to save */


        /**  create Submission */
        /**
         * handle image
         * {"name":"678085-house-128.png","type":"image\/png","tmp_name":"C:\\Users\\hoanganh25991\\AppData\\Local\\Temp\\phpE453.tmp","error":0,"size":2762}
         */
        $imageFile = $_FILES["image"];

        if($imageFile["error"] == 0){
            $image = new Image();

            /**
             * PUSH custom validator in to Image@isImage
             * ^^ cool right
             */
            $validator = Validator::make($imageFile, [
                "tmp_name" => "bail|isImage",
                "size" => "bail|max:{$image->maxFileSize()}",
            ]);

            if($validator->fails()){
                return $this->res($validator->getMessageBag()->toArray(), "image uploaded, validate fail", 422);
            }

            if(!$validator->fails()){
                /**
                 * move from temp to upload folder
                 */
                $fileNameWithExt = $imageFile["name"];

                /** NO SPACE in file name by md5  */
                $fileName = rawurlencode(pathinfo($fileNameWithExt, PATHINFO_FILENAME));
                $extension = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
                $fileNameWithExt = "{$fileName}.{$extension}";

                /** IF FILE NAME EXIST, run loop while */
                $tmpName = $fileName;
                $outputDir = Image::getUploadDir();
                if(!is_dir($outputDir) && !file_exists($outputDir)){
                    mkdir($outputDir, 777, true);
                }

                /** run loop */
                $i = 0;
                while(file_exists($outputDir . DIRECTORY_SEPARATOR . $fileName . "." . $extension)){
                    $fileName = "{$tmpName}_{$i}";
                    $fileNameWithExt = "{$fileName}.{$extension}";
                    $i++;
                }
                $imagePath = $outputDir . DIRECTORY_SEPARATOR . $fileNameWithExt;

                $tmpFileMoved = move_uploaded_file($imageFile["tmp_name"], $imagePath);

                /** move file success */
                if($tmpFileMoved){
                    $image->fill($request->all());
                    $image->fill($imageFile);
                    /**
                     * path not show where image is, just the
                     * file name
                     * when get out Image from database
                     * api give device truth link
                     */
                    $image->path = $fileNameWithExt;
                    list($width, $height) = getimagesize($imagePath);
                    $image->width = $width;
                    $image->height = $height;
                    $image->save();

                    $latestSubmission = new Submission();
                    $latestSubmission->country_id = $request->get("country_id");
                    $latestSubmission->candidate_id = $candidate->id;
                    $latestSubmission->image_id = $image->id;
                    $latestSubmission->campaign_id = $campaignId;
                    $latestSubmission->save();

                    /** device format on submission*/
                    new SubmissionDeviceFormat($latestSubmission);

                    return $this->res($latestSubmission->toArray(), "success create submission");
                }else{
                    /**
                     * can not move file
                     * permission/ect
                     */
                    return $this->res($imageFile, "can not move file", 422);
                }
            }
        }

        return $this->res($imageFile, "file upload error", 422);

    }

    /**
     * get all submissions
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        /** validate on required field for api to response */
        $validator = Validator::make($request->all(), [
            "uuid" => "required",
            "page" => "required",
            "campaign_id" => "required"
        ]);

        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray(), "", 422);
        }

        $page = $request->get("page");
        $offset = self::LIMIT * ($page - 1);

        $uuid = $request->get("uuid");
        $device = Device::where("uuid", $uuid)->first();
        $deviceId = $device->id;

        /** Submissions base on CampaignId */
        $campaignId = $request->get("campaign_id");
        /** return $data */
        $query = Submission::with(["image", "candidate", "likeByDevice" => function($relation) use($deviceId){
            $relation->where("device_id", $deviceId);
        }])->where("campaign_id", $campaignId);
        
        /** filter on country Id */
        $countryId = null;
        $countryId = $request->get("country_id");
        if($countryId){
            $query = $query->where("country_id", $countryId);
        }
        
        /* get submission */
        $allSubmissions = $query->skip($offset)->take(self::LIMIT)->get();
        foreach($allSubmissions as $s){
            new SubmissionDeviceFormat($s);
        }

        return $this->res($allSubmissions->toArray());
    }
}

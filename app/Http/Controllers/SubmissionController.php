<?php

namespace App\Http\Controllers;

use App\Candidate;
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
        $validator = Validator::make($request->all(), [
            "contact_number" => "bail|required",
            "uuid" => "required",
            "image" => "bail|required",
        ]);


        /**
         * contact number is IDENTIFIER
         * base on contact number, define candidate
         */
        $candidate = Candidate::with("device")->where("contact_number", $request->get("contact_number"))->first();
        $device = Device::with("candidate")->where("uuid", $request->get("uuid"))->first();
        /**
         * |0|1|
         * |0|1|
         */
        if(!$candidate){
            /** 0-0, new candidate, new device */
            if(!$device){
                $device = new Device($request->all());
                $device->uuid = $request->uuid;
                $candidate = new Candidate($request->all());
                $candidate->save();

                $device->candidate_id = $candidate->id;
                $device->save();
            }

            /** 0-1, no candidate, but device belongTo "someone" */
            /** many he submit wrong phone number|borrow phone */
            if($device){
                $this->res($request->all(), "may wrong phone number | borrow phone", 422);
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

        /** submission with 24-hr */
        $latestSubmission = Submission::orderBy("created_at", "desc")->where("candidate_id", $candidate->id)->first();

        $createdAt = $latestSubmission->created_at;
        $delta = time() - $createdAt;
        if($delta < 1 * 60){
            new SubmissionDeviceFormat($latestSubmission);
            return $this->res($latestSubmission->toArray(), "only one submission in 24 hr", 422);
        }

        /** move on to save */

        /** check validate */
        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray());
        }

        if(!$validator->fails()){
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
                     * move from temp to /public/upload/
                     */
                    $fileNameWithExt = $imageFile["name"];

                    /** NO SPACE in file name by md5  */
                    $fileName = md5(pathinfo($fileNameWithExt, PATHINFO_FILENAME));
                    $extension = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
                    $fileNameWithExt = "{$fileName}.{$extension}";

                    /** IF FILE NAME EXIST, run loop while */
                    $tmpName = $fileName;
                    $outputDir = env("UPLOAD_FOLDER");
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
//                        $image->path = $imagePath;
                        $image->path = $fileNameWithExt;
                        list($width, $height) = getimagesize($imagePath);
                        $image->width = $width;
                        $image->height = $height;
                        $image->save();

                        $latestSubmission = new Submission();
                        $latestSubmission->country_id = $request->get("country_id");
                        $latestSubmission->candidate_id = $candidate->id;
                        $latestSubmission->image_id = $image->id;
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

            if($imageFile["error"] > 0){
                return $this->res($imageFile, "file upload error", 422);
            }
        }

        return $this->res("", WARNING);
    }

    /**
     * get all submissions
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        /** validate on required field for api to response */
        $validator = Validator::make($request->all(), [
//            "uuid" => "required",
"page" => "required"
        ]);

        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray(), "", 422);
        }

//        $uuid = $request->get("uuid");
        $page = $request->get("page");
        $offset = self::LIMIT * ($page - 1);
//        $device = Device::with([
//            "candidate" => function ($relation) use ($page){
//                $relation->with([
//                    "submission" => function ($relation) use ($page){
//                        $offset = self::LIMIT * ($page - 1);
//                        $relation->with("image", "candidate")->skip($offset)->take(self::LIMIT);
//                    }
//                ]);
//            }
//        ])->where("uuid", $uuid)->first();

//        $deviceInfo = new \stdClass();
//        if($device){
//            $deviceInfo = $device->toArray();
//        }
//
//        return $this->res($deviceInfo);

        /** return $data */
        /** return $data */
        $allSubmissions = Submission::with("image", "candidate")->skip($offset)->take(self::LIMIT)->get();
        foreach($allSubmissions as $s){
            new SubmissionDeviceFormat($s);
        }

        return $this->res($allSubmissions->toArray());
    }
}

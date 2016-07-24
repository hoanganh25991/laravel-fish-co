<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Country;
use App\Device;
use App\Http\Requests;
use App\Http\Requests\UuidRequest;
use App\Image;
use App\Submission;
use App\SubmissionDeviceFormat;
use App\Traits\ApiResponse;
use App\Traits\ApiUtil;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Http\Request;
use Validator;

class SubmissionController extends Controller{
    use ApiUtil;
    use ApiResponse;
    const WARNING = "sorry, we still not handle this situation";

    const LIMIT_PER_PAGE = 20;


    public function create(UuidRequest $request){
        // validate

        //get accepted id of country
        $countryIdArray = implode(',', Country::lists("id")->toArray());

        $validator = Validator::make($request->all(), [
            "contact_number" => "required",
            "image" => "required|image",
            "country_id" => "required|in:{$countryIdArray}",
            "campaign_id" => "required"
        ]);

        if($validator->fails()){
            return $this->res($validator->getMessageBag());
        }
        /*
         * contact number is IDENTIFIER
         * base on contact number, define candidate
         */
        $contact_number = $request->get("contact_number");
        $candidate = Candidate::where("contact_number", $contact_number)->first();
        //no candiate match contact_number
        //new candidate, create him
        if(!$candidate){
            //contact_number is unique
            //must be supply when created
            $candidate = new Candidate(compact("contact_number"));
        }
        //update $candidate info
        $candidate->fill($request->all());
        $candidate->save();

        $uuid = $request->get("uuid");
        $device = Device::where("uuid", $uuid)->first();
        //if no device
        //create new one
        if(!$device){
            //uuid is unique
            //must be supply when created
            $device = new Device(compact("uuid"));
        }
        //update $device info
        $device->fill($request->all());
        //map candidate-device
        $device->candidate_id = $candidate->id;
        $device->save();

        //$candidate, $device checked OK

        //Submission base on CampaignId
        $campaignId = $request->get("campaign_id");

        //submission with 24-hr */
        //get latest submission from candidate
        $submission = Submission::where("campaign_id", $campaignId)->orderBy("created_at", "desc")
            ->where("candidate_id", $candidate->id)->first();

        if($submission){
            $createdAt = $submission->created_at;
            $delta = time() - $createdAt;
            if($delta < 1){
                $submission->transformForDevice();
                return $this->res($submission->toArray(), "only one submission in 24 hr", 422);
            }
        }

        //create Submission
        /*
         * handle image
         * {
         *      "name":"678085-house-128.png",
         *      "type":"image\/png",
         *      "tmp_name":"C:\\Users\\hoanganh25991\\AppData\\Local\\Temp\\phpE453.tmp",
         *      "error":0,"size":2762
         * }
         */

        $image = new Image();

        try{
            $info = $image->storeImageInUpload();
            $imagePath = $info["image_path"];
            $fileName = $info["file_name"];
        }catch(\Exception $e){
            return $this->res($request->all(), $e->getMessage(), 422);
        }

        //move file success
        //update info
        $image->fill($request->all());
        $image->fill($_FILES["image"]);
        $image->path = $fileName;
        list($width, $height) = getimagesize($imagePath);
        $image->width = $width;
        $image->height = $height;
        $image->save();

        $submission = new Submission();
        $submission->country_id = $request->get("country_id");
        $submission->candidate_id = $candidate->id;
        $submission->image_id = $image->id;
        $submission->campaign_id = $campaignId;
        $submission->save();

        /** device format on submission*/
        //load $image for device
        //when call $submission->image
        //if relation loaded, just return
        //if not, laravel auto call with("image")
        //then load image-model into $submission at relation
        $submission->image;

        $submission->transformForDevice();
        return $this->res($submission);
    }

    /**
     * get all submissions
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(UuidRequest $request){
        $uuid = $request->get("uuid");
        $device = Device::with("candidate")->where("uuid", $uuid)->first();

        //submission
        $deviceId = $device->id;
        $campaignId = $request->get("campaign_id");
        /** return $data */
        $query = Submission::campaign($campaignId)
            ->likeCount()
            ->with([
                "image",
                "candidate",
                "likeByDevice" => function ($like) use ($deviceId){
                    $like->where("device_id", $deviceId);
                }
            ]);


        /** filter on country Id */
        $countryId = $request->get("country_id");
        if($countryId){
            $query = $query->where("country_id", $countryId);
        }

        $page = $request->get("page");
        //if page field exist
        //create offset & limit
        if($page && is_numeric($page)){
            //limit
            $limit = $request->get("limit");
            if(!$limit || !is_numeric($limit)){
                $limit = self::LIMIT_PER_PAGE;
            }

            //offset
            $offset = $limit * ($page - 1);
            $query->skip($offset)->take($limit);
        }

        //get submissions
        $submissions = $query->get();
//        dd($submissions);
        foreach($submissions as $submission){
            $submission->transformForDevice();
        }

        return $this->res($submissions);
    }
}

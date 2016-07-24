<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests\UuidRequest;
use App\Like;
use App\Submission;
use App\SubmissionDeviceFormat;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

use App\Http\Requests;

class LikeController extends Controller{
    use ApiResponse;

    public function index(UuidRequest $request){
        $validator = \Validator::make($request->all(), [
            "submission_id" => "required"
        ]);

        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray());
        }

        $uuid = $request->get("uuid");
        $submissionId = $request->get("submission_id");
        $campaignId = $request->get("campaign_id");

        $submission = Submission::
                        campaign($campaignId)    
                        ->where("id", $submissionId)
                        ->first();
        if(!$submission){
            return $this->res($request->all(), "no submission found", 422);
        }

        $device = Device::
                    with("candidate")
                    ->where("uuid", $uuid)
                    ->first();
        if(!$device){
            return $this->res($request->all(), "no device found", 422);
        }
        $deviceId = $device->id;

        $like = Like::
                    where("device_id", $deviceId)
                    ->where("submission_id", $submissionId)
                    ->first();
        
        if($like){
            return $this->res($request->all(), "candidate has like this submission", 422);
        }
        
        $like = new Like();
        
        //map submission
        $like->submission_id = $submissionId;
        
        //map candidate
        $candidate = $device->candidate;
        if($candidate){
            $like->candidate_id = $candidate->id;
        }
        
        //map device
        $like->device_id = $device->id;
        $like->save();

        
        //load submission (which liked) for response
        $submission = Submission::
                        campaign($campaignId)
                        ->with([
                            "candidate",
                            "like", 
                            "image", 
                            "likeByDevice" => function($like) 
                                use($deviceId){
                                    $like->where("device_id", $deviceId);
                                }])
                        ->where("id", $submissionId)
                        ->first();

        $submission->transformForDevice();

        return $this->res($submission);
    }

    public function unlike(Request $request){
        $validator = \Validator::make($request->all(), [
            "submission_id" => "required"
        ]);

        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray());
        }

        $uuid = $request->get("uuid");
        
        $device = Device::where("uuid", $uuid)->first();
        
        $campaignId = $request->get("campaign_id");
        
        $submissionId = $request->get("submission_id");
        
        
        $submissionUnliked = Submission::
                                campaign($campaignId)
                                ->where("id", $submissionId)
                                ->first();
        
        if(!$device){
            return $this->res($request->all(), "no device found", 422);
        }
        
        if(!$submissionUnliked){
            return $this->res($request->all(), "no submission found", 422);
        }
        
        $like = Like::
                    where("device_id", $device->id)
                    ->where("submission_id", $submissionId)
                    ->first();
        
        if(!$like){
            return $this->res($request->all(), "no like found, base on request", 422);
        }
        
        $like->delete();
        
        
        $deviceId = $device->id;
        //load submission (which unliked) for response
        $submission = Submission::
        campaign($campaignId)
            ->with([
                "candidate",
                "like",
                "image",
                "likeByDevice" => function($like)
                use($deviceId){
                    $like->where("device_id", $deviceId);
                }])
            ->where("id", $submissionId)
            ->first();

        $submission->transformForDevice();

        return $this->res($submission);
    }
}

<?php

namespace App\Http\Controllers;

use App\Device;
use App\Like;
use App\Submission;
use App\SubmissionDeviceFormat;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

use App\Http\Requests;

class LikeController extends Controller{
    use ApiResponse;

    public function index(Request $request){
        $validator = \Validator::make($request->all(), [
            "uuid" => "required",
            "submission_id" => "required"
        ]);

        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray());
        }

        $uuid = $request->get("uuid");
        $submissionId = $request->get("submission_id");

        $submission = Submission::where("id", $submissionId)->first();
        if(!$submission){
            return $this->res($request->all(), "no submission found", 422);
        }

        $device = Device::with("candidate")->where("uuid", $uuid)->first();
        if(!$device){
            return $this->res($request->all(), "no device found", 422);
        }
        $deviceId = $device->id;

        $like = Like::where("device_id", $deviceId)->where("submission_id", $submissionId)->first();
        
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

        $submission = Submission::with(["candidate", "like", "image", "likeByDevice" => function($relation) use($deviceId){
            $relation->where("device_id", $deviceId)->take(1);
        }])->where("id", $submissionId)->first();

        new SubmissionDeviceFormat($submission);

        return $this->res($submission->toArray());
    }

    public function unlike(Request $request){
        $validator = \Validator::make($request->all(), [
            "uuid" => "required",
            "submission_id" => "required"
        ]);

        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray());
        }

        $uuid = $request->get("uuid");
        $device = Device::where("uuid", $uuid)->first();
        
        $submissionId = $request->get("submission_id");
        $submissionUnliked = Submission::where("id", $submissionId)->first();
        
        if(!$device){
            return $this->res($request->all(), "no device found", 422);
        }
        
        if(!$submissionUnliked){
            return $this->res($request->all(), "no submission found", 422);
        }
        
        $like = Like::where("device_id", $device->id)
            ->where("submission_id", $submissionId)
            ->first();
        
        if(!$like){
            return $this->res($request->all(), "no like found, base on request", 422);
        }
        
        $like->delete();

        $deviceId = $device->id;
        $submission = Submission::with(["candidate", "like", "image", "likeByDevice" => function($relation) use($deviceId){
            $relation->where("device_id", $deviceId)->take(1);
        }])->where("id", $submissionId)->first();

       
//        new SubmissionDeviceFormat($submissionUnliked);
       
//        return $this->res($submissionUnliked->toArray());

        new SubmissionDeviceFormat($submission);

        return $this->res($submission->toArray());
    }
}

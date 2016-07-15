<?php

namespace App\Http\Controllers;

use App\Device;
use App\Like;
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

        $device = Device::with("candidate")->where("uuid", $uuid)->first();

        try{
            $candidate = $device->candidate;
            /** new like, link to device, candidate, submission */
            $like = new Like();
            $like->device_id = $device->id;
            $like->candidate_id = $candidate->id;
            $like->submission_id = $submissionId;
            $like->save();
            return $this->res($like->toArray());
        }catch(\Exception $e){
            return $this->res($request->all(), $e->getMessage(), 422);
        }
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
        $like = Like::where("device_id", $device->id)
            ->where("submission_id", $submissionId)
            ->first();
        if(!$like){
            return $this->res($request->all(), "no like found, base on request", 422);
        }
        
        $like->delete();

        $log = "like on submission_id: {$submissionId}, device_uuid: {$uuid} deleted";
        return $this->res($log);
    }
}

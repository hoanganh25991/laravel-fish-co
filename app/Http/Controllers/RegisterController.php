<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests;
use App\SubmissionDeviceFormat;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Validator;

use App\Http\Requests\ApiRequest;

class RegisterController extends Controller{
    use ApiResponse;

    public function index(Request $request){
        /** validate on required field to get json from api */
        $validator = Validator::make($request->all(), [
            "uuid" => "required"
        ]);

        /** validate fail */
        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray(), "", 422);
        }

        /** find out device */
        $device = null;

        /* find him in db */
        $uuid = $request->get("uuid");
        $device = Device::with([
            "candidate.submission" => function ($relation){
                $relation->with(["image", "like"]);
//                $relation->with("like");
            }
        ])->where("uuid", $uuid)->first();

        /* create new device if no one */
        if(!$device){
            $device = new Device($request->all());
            $device->save();
        }

        /** token */
        $token = (new TokenController)->get();

        /** find candidate */
        $candidate = null;
        if($device){
            $candidate = $device->candidate;
            unset($device->candidate);
        }

        /** submission */
        $submission = null;
        if($candidate){
            $submission = $candidate->submission;
            
            foreach($submission as $aSubmission){
                new SubmissionDeviceFormat($aSubmission);
            }

            unset($candidate->submission);
        }

        $r = [
            "token" => $token,
            "device" => $device,
            "candidate" => $candidate,
            "submissions" => $submission,
        ];
        return $this->res($r);
    }
}

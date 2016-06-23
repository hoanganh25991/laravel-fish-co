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

        $uuid = $request->get("uuid");
        $device = Device::with([
            "candidate.submission" => function ($relation){
                $relation->with("image");
            }
        ])->where("uuid", $uuid)->first();


        /** rebuild for device format*/
        $candidate = $device->candidate;
        unset($device->candidate);

        /** submission */
        $submissionArray = $candidate->submission;
        unset($candidate->submission);
        foreach($submissionArray as $s){
            new SubmissionDeviceFormat($s);
        }

        /** token */
        $token = (new TokenController)->get();

        if(!$device){
            $this->res([
                "token" => $token,
                "device" => new \stdClass,
                "candidate" => new \stdClass,
                "submissions" => new \stdClass,
            ]);
        }

        return $this->res([
            "token" => $token,
            "device" => $device,
            "candidate" => $candidate,
            "submissions" => $submissionArray
        ]);
    }
}

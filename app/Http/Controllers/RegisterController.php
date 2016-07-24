<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests;
use App\SubmissionDeviceFormat;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Validator;

use App\Http\Requests\UuidRequest;

class RegisterController extends Controller{
    use ApiResponse;

    public function index(UuidRequest $request){
        /* find device in db */
        $uuid = $request->get("uuid");
        $device = Device::where("uuid", $uuid)->first();
        $deviceId = $device->id;
        
        $device = Device::with([
            "candidate" => function ($candidate){
                $device = $candidate->getParent();
                $deviceId = $device->id;
                $candidate->with([
                    "submission" => function($submission) use($deviceId){
                        $submission
                            ->selectRaw("submission.*, count(like.id) as like_count")
                            ->orderBy("submission.created_at", "desc")
                            ->leftJoin("like", "like.submission_id", "=", "submission.id")
                            ->groupBy("like.id")
                            ->with("image")
                            ->with([
                                "likeByDevice" => function($like) use($deviceId){
                                    $like->where("device_id", $deviceId);
                                }
                            ]);
                    }
                ]);
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
//        if($candidate){
//            $submission = $candidate->submission;
//
//            foreach($submission as $aSubmission){
//                $a = new SubmissionDeviceFormat($aSubmission);
//                $b = 0;
//            }
//
//            unset($candidate->submission);
//        }

        $r = [
            "token" => $token,
            "device" => $device,
            "candidate" => $candidate,
            "submissions" => $candidate->submission,
        ];
        return $this->res($r);
    }
}

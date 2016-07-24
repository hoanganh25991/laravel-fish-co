<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests;
use App\Http\Requests\UuidRequest;
use App\Submission;
use App\SubmissionDeviceFormat;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Validator;

class RegisterController extends Controller{
    use ApiResponse;

    public function index(UuidRequest $request){
        /* find device in db */
        $uuid = $request->get("uuid");
        $campaignId = $request->get("campaign_id");
        $device = Device::with([
            "candidate" => function ($candidate) 
                use ($campaignId){
                    $candidate->with([
                        "submission" => function ($submission)
                            use ( $campaignId){
                                $submission
                                    ->campaign($campaignId)
                                    ->likeCount()
                                    ->with("image");
                            }
                    ]);
                }
        ])->where("uuid", $uuid)->first();

        /* create new device if not found */
        if(!$device){
            $device = new Device($request->all());
            $device->save();
        }

        /** token */
        $token = (new TokenController)->get();

        /** find candidate */
        $candidate = $device->candidate;
        unset($device->candidate);

        /** submission */
        $submission = null;
        if($candidate){
            $submission = $candidate->submission;
//            dd($submission);
            foreach($submission as $singleSubmission){
                /** @var Submission $singleSubmission */
                $singleSubmission->transformForDevice();
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

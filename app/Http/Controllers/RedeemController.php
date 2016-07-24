<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Requests\UuidRequest;
use App\Submission;
use App\SubmissionDeviceFormat;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class RedeemController extends Controller{
    use ApiResponse;

    public function index(UuidRequest $request){
        /** required field to call this API */
        $validator = \Validator::make($request->all(), [
            "submission_id" => "required",
        ]);

        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray());
        }

        /** find $submission */
        $campaignId = $request->get("campaign_id");

        $submission = null;
        $submission = Submission::
            campaign($campaignId)
            ->where("id", $request->get("submission_id"))->first();

        if($submission){
            $submission->redeem_at = Carbon::now();
            $submission->save();

            $submission->transformForDevice();
            return $this->res($submission->toArray());
        }

        return $this->res($request->all(), "submission not found", 422);
    }
}

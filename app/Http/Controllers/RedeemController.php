<?php

namespace App\Http\Controllers;

use App\Submission;
use App\SubmissionDeviceFormat;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

use App\Http\Requests;

class RedeemController extends Controller{
    use ApiResponse;

    public function index(Request $request){
        /** required field to call this API */
        $validator = \Validator::make($request->all(), [
            "uuid" => "required",
            "submission_id" => "required",
        ]);

        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray());
        }
        
        $submission = Submission::find($request->get("submission_id"));
        $submission->redeem_at = time();
        $submission->save();
        
        new SubmissionDeviceFormat($submission);
        return $this->res($submission->toArray());
    }
}

<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\SubmissionImage;
use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;

class SubmissionController extends Controller{
    const WARNING = "sorry, we still not handle this situation";

    public function create(Request $request){
        /**
         * validate
         */
        $validator = Validator::make($request->all(), [
            SubmissionImage::TABLE => "bail|required",
            Candidate::CONTACT_NUMBER => "bail|required",
        ]);
        if($validator->fails()){
            return Response::json($validator->getMessageBag()->toArray(), 422);
        }
        if(!$validator->fails()){
//            return json_encode(["hello" => "world"]);
        }
        return json_encode(self::WARNING);
    }
}

<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Device;
use App\Http\Requests;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Validator;
use Response;

class CandidateController extends Controller{
    use ApiResponse;
    const WARNING = "sorry, we still not handle this situation";
    const STATUS_CODE = "statusCode";
    const STATUS_MSG = "statusMsg";
    const DATA = "data";

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            "uuid" => "required",
        ]);
        /** check validate */
        if($validator->fails()){
            return $this->res($validator->getMessageBag()->toArray());
        }

        $uuid = $request->get("uuid");
        $device = Device::with("candidate")->where("uuid", $uuid)->first();
        $candidate = $device->candidate;

        if(!$candidate){
            $candidate = new Candidate();
        }

        $candidate->fill($request->all());
        $candidate->save();

        //map device-candidate
        $device->candidate_id = $candidate->id;
        $device->save();

        return $this->res($candidate->toArray());
    }

    public function verify(Request $request){
        $uuid = $request->get("uuid");
        $device = Device::with("candidate")->where("uuid", $uuid)->first();
        
        if($device){
            $candidate = $device->candidate;
            return Response::json([
                self::STATUS_CODE => 200,
                self::STATUS_MSG => "success find candidate base on device",
                self::DATA => $candidate->toArray()
            ]);
        }
        if(!$device){
            //return empty object "{}"
//            return json_encode(new stdClass);
            return Response::json([
                self::STATUS_CODE => 418,
                self::STATUS_MSG => "no candidate found base on device",
                self::DATA => $uuid
            ]);
        }
//        return json_encode(self::WARNING);
        return Response::json([
            self::STATUS_CODE => 200,
            self::STATUS_MSG => self::WARNING,
            self::DATA => $request->all()
        ]);
    }
}

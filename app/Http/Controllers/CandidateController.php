<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests;
use Illuminate\Http\Request;
use Response;
use stdClass;

class CandidateController extends Controller{
    const WARNING = "sorry, we still not handle this situation";
    const STATUS_CODE = "statusCode";
    const STATUS_MSG = "statusMsg";
    const DATA = "data";

    public function create(){
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

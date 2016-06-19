<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests;
use Illuminate\Http\Request;
use stdClass;

class CandidateController extends Controller{
    const WARNING = "sorry, we still not handle this situation";
    public function create(){
        
    }
    
    public function verify(Request $request){
        $serialNumber = $request->get(Device::SERIAL_NUMBER);
        $device = Device::with("candidate")->where(Device::SERIAL_NUMBER, $serialNumber)->first();
        if($device){
            $candidate = $device->candidate;
            return $candidate->toJson();
        }
        if(!$device){
            //return empty object "{}"
            return json_encode (new stdClass);
        }
        return json_encode (self::WARNING);
    }
}

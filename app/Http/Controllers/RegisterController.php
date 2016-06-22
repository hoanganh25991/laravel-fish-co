<?php

namespace App\Http\Controllers;

use App\Device;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

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
                $relation->with("image", "country");
            }
        ])->where("uuid", $uuid)->first();
        $token = (new TokenController)->get();
        $deviceInfo = new \stdClass();
        if($device){
            $deviceInfo = $device->toArray();
        }
        return $this->res([
            "_token" => $token,
            "device" => $deviceInfo
        ]);
    }
}

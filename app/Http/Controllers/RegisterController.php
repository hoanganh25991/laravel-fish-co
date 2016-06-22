<?php

namespace App\Http\Controllers;

use App\Device;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

use App\Http\Requests;

class RegisterController extends Controller{
    use ApiResponse;

    public function index(Request $request){
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

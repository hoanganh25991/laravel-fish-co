<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class TokenController extends Controller{
    /**
     * @return string
     */
    public function get(){
//        return csrf_token();
        /**
         * when device send request, build token
         * md5(time(in minute) + KEY)
         */
        $carbon = new Carbon();
        $timestamp = $carbon->timestamp;
        $roundInMinute = ceil($timestamp / 60 / 1000);
        $key = env("FISH_CO_KEY");
        return md5("{$roundInMinute}+{$key}");
    }

    /**
     * @param string $token
     * @return bool
     */
    public function checkToken($token){
        var_dump($token, $this->get());
        if($token != $this->get()){
            return false;
        }
        return true;
    }

    public function checkToken2($clientToken){
        return [
            "clientToken" => $clientToken,
            "serverToken" => $this->get()
        ];
    }

    /**
     * THIS METHOD is belongsTo CONTROLLER
     * >should not override
     * @param Request $attribute
     * @param array $value
     * @param array $parameters
     * @param array $validator
     * @return bool
     */
//    public function validate($attribute, $value, $parameters, $validator){
//        return $this->checkToken($value);
//    }

    public function check($attribute, $value, $parameters, $validator){
        return $this->checkToken($value);
    }
}

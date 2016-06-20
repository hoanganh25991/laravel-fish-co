<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests;
use Request;
use Response;

class StoreController extends Controller{
    const WARNING = "sorry, we still not handle this situation";
    const STATUS_CODE = "statusCode";
    const STATUS_MSG = "statusMsg";
    const DATA = "data";
    
    public function index(Request $request){
        $store = Country::with("store")->get();
//        return $store->toJson();
        if($store){
            return Response::json([
                self::STATUS_CODE => 200,
                self::STATUS_MSG => "success load all store",
                self::DATA => $store->toArray(),
            ]);
        }
        return Response::json([
            self::STATUS_CODE => 200,
            self::STATUS_MSG => self::WARNING,
            self::DATA => $request->all(),
        ]);
    }

    /**
     * @param Request $request
     * @param string $countryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function byCountry(Request $request, $countryId){
        $store = Country::with("store")->where("id", $countryId)->firstOrFail();
        if($store){
            return Response::json([
                self::STATUS_CODE => 200,
                self::STATUS_MSG => "success load store by country",
                self::DATA => $store->toArray(),
            ]);
        }
        return Response::json([
            self::STATUS_CODE => 200,
            self::STATUS_MSG => self::WARNING,
            self::DATA => $request->all(),
        ]);
    }
}

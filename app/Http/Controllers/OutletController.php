<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests;
use App\Traits\ApiResponse;

class OutletController extends Controller{
    use ApiResponse;
    public function index(){ 
        $outlet = Country::with([
            "region" => function($relation){
                $relation->with([
                    "outlet" => function($re){
                        $re->orderBy("name", "asc");
                    }
                ]);
                $relation->orderBy("name", "asc");
            }
        ])->orderBy("name", "asc")->get();
        return $this->res($outlet->toArray());
    }
}

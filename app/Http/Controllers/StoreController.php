<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests;

class StoreController extends Controller{
    
    public function index(){
        $store = Country::with("store")->get();
        return $store->toJson();
    }
    public function byCountry($countryId){
        $store = Country::with("store")->where("id", $countryId)->firstOrFail();
        return $store->toJson();
    }
}

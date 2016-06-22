<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests;
use App\Traits\ApiResponse;

class OutletController extends Controller{
    use ApiResponse;
    public function index(){ 
        $outlet = Country::with("region.outlet")->get();
        return $this->res($outlet->toArray());
    }
}

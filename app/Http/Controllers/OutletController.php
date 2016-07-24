<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests;
use App\Traits\ApiResponse;

class OutletController extends Controller{
    use ApiResponse;
    public function index(){ 
        $outlet = Country::with([
                    //load region in country
                    "region" => function($region){
                        //sort region by name
                        $region->orderBy("name", "asc");

                        //load outlet from region
                        $region->with([
                            //sort outlet by name
                            "outlet" => function($outlet){
                                $outlet->orderBy("name", "asc");
                            }
                        ]);
                    }
                ])
                //sort country by name
                ->orderBy("name", "asc")
                ->get();
        return $this->res($outlet->toArray());
    }
}

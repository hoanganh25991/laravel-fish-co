<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Requests;
use App\Http\Requests\ApiRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Response;

class CampaignController extends Controller{
    use ApiResponse;
    public function index(Request $request){
        $allCampaign = Campaign::all();
        return $this->res($allCampaign->toArray());
    }
}

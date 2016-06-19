<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Requests;

class CampaignController extends Controller{
    public function index(){
        $campaign = Campaign::first();
        return $campaign->toJson();
    }
}

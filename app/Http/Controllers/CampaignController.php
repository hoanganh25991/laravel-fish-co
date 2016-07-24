<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Requests;
use App\Http\Requests\UuidRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class CampaignController extends Controller{
    use ApiResponse;
    public function index(){
        $campaigns = Campaign::submissionCount()->get();

        return $this->res($campaigns);
    }
}

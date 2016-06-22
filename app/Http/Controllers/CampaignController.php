<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Requests;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Response;

class CampaignController extends Controller{
    use ApiResponse;
    public function index(Request $request){
//        $campaign = Campaign::first();
////        return $campaign->toJson();
//
//        if($campaign){
//            return Response::json([
//                self::STATUS_CODE => 200,
//                self::STATUS_MSG => "success load campaign",
//                self::DATA => $campaign->toArray(),
//            ]);
//        }
//        return Response::json([
//            self::STATUS_CODE => 200,
//            self::STATUS_MSG => self::WARNING,
//            self::DATA => $request->all(),
//        ]);
        $allCampaign = Campaign::all();
        return $this->res($allCampaign->toArray());
    }
}

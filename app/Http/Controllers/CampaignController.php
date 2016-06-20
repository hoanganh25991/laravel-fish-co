<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Requests;
use Request;
use Response;

class CampaignController extends Controller{
    const WARNING = "sorry, we still not handle this situation";
    const STATUS_CODE = "statusCode";
    const STATUS_MSG = "statusMsg";
    const DATA = "data";

    public function index(Request $request){
        $campaign = Campaign::first();
//        return $campaign->toJson();

        if($campaign){
            return Response::json([
                self::STATUS_CODE => 200,
                self::STATUS_MSG => "success load campaign",
                self::DATA => $campaign->toArray(),
            ]);
        }
        return Response::json([
            self::STATUS_CODE => 200,
            self::STATUS_MSG => self::WARNING,
            self::DATA => $request->all(),
        ]);
    }
}

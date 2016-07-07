<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Http\Requests;
use App\Http\Requests\ApiRequest;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class CampaignController extends Controller{
    use ApiResponse;
    public function index(Request $request){
//        $allCampaign = Campaign::;
//        return $this->res($allCampaign->toArray());
//        $campaigns = DB::select("select *,count(submission.id) as submissions from campaign left join submission on campaign.id = submission.campaign_id GROUP by campaign.id;");
        $campaigns = Campaign::with(["submission"=> function($relation){
            $relation->count();
        }])->get();
        foreach($campaigns as $campaign){
            $submissions = $campaign->submission;
            unset($campaign->submission);
            $campaign->submission_count = $submissions->count();
        }
        return $this->res($campaigns);
    }
}

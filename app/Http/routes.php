<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Device;
use App\Submission;
use Illuminate\Http\Request;

/** device HAVE TO SEND TO /api/regiter to get token*/
Route::group(["prefix" => "api"], function(){
    Route::get("register", "RegisterController@index");
    Route::post("register", "RegisterController@index");

    Route::get("outlets", "OutletController@index");
    Route::post("outlets", "OutletController@index");
});

Route::group([
    "middleware" => "token",
    "prefix" => "api"
], function (){
    Route::get("campaigns", "CampaignController@index");
    Route::post("campaigns", "CampaignController@index");

    Route::get("submissions", "SubmissionController@index");
    Route::post("submissions", "SubmissionController@index");

    Route::get("submission", "SubmissionController@create");
    Route::post("submission", "SubmissionController@create");

    Route::post("redeem", "RedeemController@index");
    Route::post("like", "LikeController@index");
});

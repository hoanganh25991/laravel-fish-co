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
Route::group(["prefix" => "api"], function(){
    //call register to get token
    Route::get("register", "RegisterController@index");
    Route::post("register", "RegisterController@index");

    Route::get("outlets", "OutletController@index");
    Route::post("outlets", "OutletController@index");
    
    //restrict routes by token
    Route::group(["middleware" => "token"], function(){
        Route::get("campaigns", "CampaignController@index");
        Route::post("campaigns", "CampaignController@index");

        Route::get("submissions", "SubmissionController@index");
        Route::post("submissions", "SubmissionController@index");

        Route::get("submission", "SubmissionController@create");
        Route::post("submission", "SubmissionController@create");

        Route::post("redeem", "RedeemController@index");
        Route::post("like", "LikeController@index");

        Route::post("candidate", "CandidateController@update");

        Route::post("unlike", "LikeController@unlike");
    });

    //test image
    Route::get("images", "ImageController@index");
    //test function
    Route::get("util", "UtilController@index");
});

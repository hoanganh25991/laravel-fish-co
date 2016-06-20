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

Route::get('', function (){
    return view('welcome');
});
Route::get("store/index", "StoreController@index");
Route::post("store/index", "StoreController@index");

Route::get("store/{countryId}", "StoreController@byCountry");
Route::post("store/{countryId}", "StoreController@byCountry");

Route::get("campaign/index", "CampaignController@index");
Route::post("campaign/index", "CampaignController@index");
/**
 * Base on device.serial_number detect new/old candidate
 */
Route::get("token", "TokenController@get");
Route::post("token", "TokenController@get");

Route::get("token/test/{md5Hash}", "TokenController@testToken");

Route::post("candidate/verify", "CandidateController@verify");
/**
 * protected API
 */
Route::group(['middleware' => "token"], function () {
    Route::post("submission/create", "SubmissionController@create");
//Route::get("submission/create", "SubmissionController@create");
    Route::post("submission/index", "SubmissionController@index");
    Route::post("submission/country", "SubmissionController@byCountry");
});



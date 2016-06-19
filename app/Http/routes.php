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
Route::get("store/{countryId}", "StoreController@byCountry");
Route::get("campaign/index", "CampaignController@index");
/**
 * Base on device.serial_number detect new/old candidate
 */
Route::get("token", "TokenController@get");
Route::post("candidate/verify", "CandidateController@verify");

Route::post("submission/create", "SubmissionController@create");
Route::get("submission/create", "SubmissionController@create");

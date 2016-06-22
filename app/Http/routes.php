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

Route::get("register","RegisterController@index");
Route::post("register", "RegisterController@index");

Route::get("campaigns", "CampaignController@index");
Route::get("outlets", "OutletController@index");
Route::post("submissions", "SubmissionController@index");
Route::post("submission", "SubmissionController@create");


//Route::group(['middleware' => "token"], function (){
//    Route::post("api", function(Request $request){
//        $model = $request->get("model");
//        $action = $request->get("action");
//        $capitalName = ucfirst($model);
//        $controller = "App\\Http\\Controllers\\{$capitalName}Controller";
////        $r = (new $controller)->$action($request);
////        return $r;
//        return (new $controller)->$action($request);
//    });
//    Route::post("{controllerName}/{action}", function($controllerName, $action, Request $request){
//        $capitalName = ucfirst($controllerName);
//        $controller = "App\\Http\\Controllers\\{$capitalName}Controller";
//        $r = (new $controller)->$action($request);
//        return $r;
//    });
//});
//
//Route::get('', function (){
//    return view('welcome');
//});
//Route::get("store/index", "StoreController@index");
//Route::post("store/index", "StoreController@index");
//
//Route::get("store/{countryId}", "StoreController@byCountry");
//Route::post("store/{countryId}", "StoreController@byCountry");
//
//Route::get("campaign/index", "CampaignController@index");
//Route::post("campaign/index", "CampaignController@index");
///**
// * Base on device.serial_number detect new/old candidate
// */
//Route::get("token", "TokenController@get");
//Route::post("token", "TokenController@get");
//
//Route::get("token/test/{md5Hash}", "TokenController@test");
//
//Route::post("candidate/verify", "CandidateController@verify");
//
//Route::post("image/index", "ImageController@index");

Route::post("submission/image", function (Request $request){
    $country_id = $request->get(Submission::COUNTRY_ID);
    $serialNumber = $request->get(Device::SERIAL_NUMBER);
    /** @var \App\BaseModel $candidate */
    $candidate = Device::with([
//        "candidate.submission" => function ($relation) use ($country_id){
//            $relation->with("submissionImage.image");
//            $relation->where(Submission::COUNTRY_ID, $country_id);
//        },
"candidate.submission" => function ($relation) use ($country_id){
    $relation->with("submissionImage.image")->where(Submission::COUNTRY_ID, $country_id);
},
    ])->where(Device::SERIAL_NUMBER, $serialNumber)->first()->candidate;
    $submission = $candidate->submission;
    foreach($submission as $s){
        /** @var Submission $a */
        $submissionImageArray = $s->submissionImage;
        $imageArray = [];
        foreach($submissionImageArray as $sb){
            $imageArray[] = $sb->image;
        }
        /** @var Submission $s */
        $s->setAttribute("image", $imageArray);
    }
    return Response::json([
        "statusCode" => 200,
        "statusMsg" => "success load submission by candidate and country",
        "data" => $submission->toArray()
    ], 200);
});
/**
 * protected API
 */
Route::group(['middleware' => "token"], function (){
    Route::post("submission/create", "SubmissionController@create");
//Route::get("submission/create", "SubmissionController@create");
    Route::post("submission/index", "SubmissionController@index");
    Route::post("submission/country", "SubmissionController@byCountry");

    Route::post("{controllerName}/{action}", function($controllerName, $action, Request $request){
        $capitalName = ucfirst($controllerName);
        $controller = "App\\Http\\Controllers\\{$capitalName}Controller";
        $r = (new $controller)->$action($request);
        return $r;
    });
});



<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;

class ImageController extends Controller{
    const WARNING = "sorry, we still not handle this situation";
    const STATUS_CODE = "statusCode";
    const STATUS_MSG = "statusMsg";
    const DATA = "data";
    
    public function index(){
        $images = Image::all();
        return \Response::json([
            self::STATUS_CODE => 200,
            self::STATUS_MSG => "success load all store",
            self::DATA => $images->toArray(),
        ]);
    }
}

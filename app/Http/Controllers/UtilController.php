<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;

class UtilController extends Controller
{
    public function index(){
        $wrongEnv = env("ABC_DEF");
        $uploadFolder = base_path() . "/uploads";
        $ouputDir = $wrongEnv ? $wrongEnv : $uploadFolder;

        $imageUrl = url("");
        $imageUrl2 = substr($imageUrl, 0, strrpos($imageUrl, "/"));
        $imageUrl3 = substr(url(""), 0, strrpos(url(""), "/"));

        var_dump(Image::getUploadDir(), $imageUrl, $imageUrl2, $imageUrl3);
    }
}

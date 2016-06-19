<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TokenController extends Controller{
    public function get(){
        return csrf_token();
    }
}

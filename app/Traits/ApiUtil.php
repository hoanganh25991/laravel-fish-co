<?php

namespace App\Traits;

use Carbon\Carbon;

trait ApiUtil{
    public function timestamp($value){
        $carbon = new Carbon($value);
        $unixTimestamp = $carbon->timestamp;
        return $unixTimestamp;
    }
}
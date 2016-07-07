<?php

namespace App\Traits;

use Carbon\Carbon;

trait ApiUtil{
    public function timestamp($value){
        $carbon = new Carbon($value);
        $unixTimestamp = $carbon->timestamp;
        return $unixTimestamp;
    }

    /**
     * most of the time, file saved at `uploads` folder
     * like a helper function, get out the url
     * @param $filePath
     * @return null|string
     */
    public function getUrl($filePath){
        if(!$filePath){
            return null;
        }
        /**
         * instead of return $this->attributes["path"]
         * return full linkt for device
         */
        $relativeLink = substr(url(""), 0, strrpos(url(""), "/")) . "/uploads" . "/" . rawurlencode($filePath);
        return $relativeLink;
    }

    public static function getUploadDir(){
        return substr(base_path(), 0, strrpos(base_path(), "/")) . DIRECTORY_SEPARATOR . "uploads";
    }
}
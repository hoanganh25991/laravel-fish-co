<?php

namespace App;

class Country extends BaseModel{
    protected $table = "country";

    protected $fillable = [
        "name",
        "country_code",
        "instagram_url",
        "website_url",
        "facebook_url",
        "twitter_url",
        "flag_image",
        "cover_image"
    ];
    
    public function region(){
        return $this->hasMany(Region::class, "country_id", "id");
    }

    public function getFlagImageAttribute($imageName){
        /**
         * instead of return $this->attributes["path"]
         * return full linkt for device
         */
        if(!$imageName){
            return null;
        }
        $uploadFoler = env("UPLOAD_DIRECTORY")? env("UPLOAD_DIRECTORY") : "../uploads";
        $relativeLink = $uploadFoler . "/" . $imageName;
        $realLink = asset($relativeLink);
        return $realLink;
    }

    public function getCoverImageAttribute($imageName){
        if(!$imageName){
            return null;
        }
        /**
         * instead of return $this->attributes["path"]
         * return full linkt for device
         */
        $uploadFoler = env("UPLOAD_DIRECTORY")? env("UPLOAD_DIRECTORY") : "../uploads";
        $relativeLink = $uploadFoler . "/" . $imageName;
        $realLink = asset($relativeLink);
        return $realLink;
    }
}

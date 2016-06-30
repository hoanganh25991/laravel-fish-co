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
         * >hostname + /upload/ + filename
         */
        $uploadFoler = env("UPLOAD_DIRECTORY")? env("UPLOAD_DIRECTORY") : "public/upload";
        $relativeLink = $uploadFoler . "/" . $imageName;
        $realLink = asset($relativeLink);
        return $realLink;
    }

    public function getCoverImageAttribute($imageName){
        /**
         * instead of return $this->attributes["path"]
         * return full linkt for device
         * >hostname + /upload/ + filename
         */
        $uploadFoler = env("UPLOAD_DIRECTORY")? env("UPLOAD_DIRECTORY") : "public/upload";
        $relativeLink = $uploadFoler . "/" . $imageName;
        $realLink = asset($relativeLink);
        return $realLink;
    }
}

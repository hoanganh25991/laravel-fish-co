<?php

namespace App;

use App\Traits\ApiUtil;

class Country extends BaseModel{
    use ApiUtil;
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
        return $this->getUrl($imageName);
    }

    public function getCoverImageAttribute($imageName){
        return $this->getUrl($imageName);
    }
}

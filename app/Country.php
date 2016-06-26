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
        "twitter_url"
    ];
    
    public function region(){
        return $this->hasMany(Region::class, "country_id", "id");
    }
}

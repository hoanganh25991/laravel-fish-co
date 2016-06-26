<?php

namespace App;

class Region extends BaseModel{
    protected $table = "region";
    
    protected $fillable = [
        "name",
        "instagram_url",
        "website_url",
        "facebook_url",
        "twitter_url"
    ];
    public function outlet(){
        return $this->hasMany(Outlet::class, "region_id", "id");
    }
}

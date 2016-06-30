<?php

namespace App;

class Outlet extends BaseModel{
    protected $table = "outlet";

    protected $fillable = [
        "name",
        "address",
        "instagram_url",
        "website_url",
        "facebook_url",
        "twitter_url",
        "lat",
        "lng",
        "opening_hours"
    ];
}

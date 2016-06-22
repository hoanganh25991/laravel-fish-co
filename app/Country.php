<?php

namespace App;

class Country extends BaseModel{
    protected $table = "country";
    
    public function region(){
        return $this->hasMany(Region::class, "country_id", "id");
    }
}

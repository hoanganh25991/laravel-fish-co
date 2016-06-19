<?php

namespace App;

class Country extends BaseModel{
    const ID = "id";
    const NAME = "name";

    const TABLE = "country";
    protected $table = self::TABLE;
    
    public function store(){
        return $this->hasMany(Store::class, Store::COUNTRY_ID, self::ID);
    }
}

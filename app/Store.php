<?php

namespace App;

class Store extends BaseModel{
    const ID = "id";
    const NAME = "name";
    const ADDRESS = "address";
    const TEL = "tel";
    const COUNTRY_ID = "country_id";

    const TABLE = "store";
    protected $table = self::TABLE;
    
    public function country(){
        return $this->hasOne(Country::class, Country::ID, self::COUNTRY_ID);
    }
}

<?php

namespace App;

class Region extends BaseModel{
    protected $table = "region";
    
    public function outlet(){
        return $this->hasMany(Outlet::class, "region_id", "id");
    }
}

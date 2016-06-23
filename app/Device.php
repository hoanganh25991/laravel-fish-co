<?php

namespace App;

class Device extends BaseModel{
    
    protected $table ="device";
    protected $fillable = [
        "description",
        "os",
        "os_ver",
        "app_ver",
        "model",
        "manufacturer"
    ];

    public function candidate(){
        return $this->belongsTo(Candidate::class, "candidate_id");
    }

    public function save(array $options = []){
        $this->attributes["last_access"] = time();
        parent::save($options);
    }
    
    public function getLastAccessAttribute($value){
        return $this->timestamp($value);
    }

}

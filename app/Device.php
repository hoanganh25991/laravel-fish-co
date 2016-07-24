<?php

namespace App;

use Carbon\Carbon;

class Device extends BaseModel{
    
    protected $table ="device";
    protected $fillable = [
        "description",
        "os",
        "os_ver",
        "app_ver",
        "model",
        "manufacturer",
        "uuid"
    ];

    public function candidate(){
        return $this->belongsTo(Candidate::class, "candidate_id");
    }

    public function save(array $options = []){
        /** @warn */
        $this->attributes["last_access"] = Carbon::now();
        parent::save($options);
    }
    
    public function getLastAccessAttribute($value){
        return $this->timestamp($value);
    }
    
    public function loadCandidate(){
        return self::with("candidate");
    }

}

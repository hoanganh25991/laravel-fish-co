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
}

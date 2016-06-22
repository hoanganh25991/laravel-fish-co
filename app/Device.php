<?php

namespace App;

class Device extends BaseModel{
    
    protected $table ="device";
    protected $fillable = [
       
    ];

    public function candidate(){
        return $this->belongsTo(Candidate::class, "candidate_id");
    }
}

<?php

namespace App;

use Carbon\Carbon;

class Submission extends BaseModel{
    protected $table = "submission";
    protected $fillable = [
        
    ];
    protected $dates = ["redeeem_at"];

    public function country(){
        return $this->belongsTo(Country::class, "country_id");
    }

    public function candidate(){
        return $this->belongsTo(Candidate::class, "candidate_id");
    }

    public function image(){
        return $this->belongsTo(Image::class, "image_id");
    }

    public function getRedeemAtAttribute($value){
        return $this->timestamp($value);
    }
}

<?php

namespace App;

use Carbon\Carbon;

class Submission extends BaseModel{
    protected $table = "submission";
    protected $fillable = [
        "country_id",
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

//    public function like(){
//        return $this->belongsToMany(Like::class, null, "submission_id");
//    }
    public function like(){
        return $this->hasMany(Like::class, "submission_id", "id");
    }

    public function likeByDevice(){
        return $this->hasMany(Like::class, "submission_id", "id");
    }

    public function getRedeemAtAttribute($value){
        return $this->timestamp($value);
    }
}

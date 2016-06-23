<?php

namespace App;
class Submission extends BaseModel{
    protected $table = "submission";
    protected $fillable = [

    ];
    protected $dateFormat = "timestamp";

    public function country(){
        return $this->belongsTo(Country::class, "country_id");
    }

    public function candidate(){
        return $this->belongsTo(Candidate::class, "candidate_id");
    }

    public function image(){
        return $this->belongsTo(Image::class, "image_id");
    }

}

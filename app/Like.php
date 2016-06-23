<?php

namespace App;

class Like extends BaseModel{
    protected $table = "like";

    public function candidate(){
        return $this->belongsTo(Candidate::class, "candidate_id");
    }

    public function submission(){
        return $this->belongsTo(Submission::class, "submission_id");
    }

    public function device(){
        return $this->belongsTo(Device::class, "device_id");
    }
}

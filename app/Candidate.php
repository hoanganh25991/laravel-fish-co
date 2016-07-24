<?php

namespace App;


class Candidate extends BaseModel{
    protected $table = "candidate";
    protected $fillable = [
        "name",
        "email",
        "contact_number",
        "mailing_list"
    ];

    public function submission(){
        return $this->hasMany(Submission::class, "candidate_id", "id");
    }

    public function device(){
        return $this->hasMany(Device::class, "candidate_id", "id");
    }

//    public function
}

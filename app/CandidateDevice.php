<?php

namespace App;

class CandidateDevice extends BaseModel{
    const ID = "id";
    const CANDIDATE_ID = "candidate_id";
    const DEVICE_ID = "device_id";

    const TABLE = "candidate_device";
    protected $table = self::TABLE;
    
    public function device(){
        return $this->hasMany(Device::class, Device::ID, self::DEVICE_ID);
    }
    
    public function candidate(){
        return $this->hasMany(Candidate::class, Candidate::ID, self::CANDIDATE_ID);
    }
}

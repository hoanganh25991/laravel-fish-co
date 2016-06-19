<?php

namespace App;

class Device extends BaseModel{
    const ID = "id";
    const SERIAL_NUMBER = "serial_number";
    const DES = "des";
    const CANDIDATE_ID = "candidate_id";

    const TABLE = "device";
    protected $table = self::TABLE;
    protected $fillable = [
        self::SERIAL_NUMBER,
        self::DES,
        self::CANDIDATE_ID
    ];

    public function candidate(){
        return $this->hasOne(Candidate::class, Candidate::ID, self::CANDIDATE_ID);
    }


}

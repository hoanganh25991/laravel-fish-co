<?php

namespace App;


class Candidate extends BaseModel{
    const ID = "id";
    const NAME = "name";
    const EMAIL = "email";
    const CONTACT_NUMBER = "contact_number";

    const TABLE = "candidate";

    protected $table = self::TABLE;
    
    public function submission(){
        return $this->hasMany(Submission::class, self::ID);
    }
}

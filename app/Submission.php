<?php

namespace App;
//use Codesleeve\Stapler\ORM\StaplerableInterface;
//use Codesleeve\Stapler\ORM\EloquentTrait;

class Submission extends BaseModel{
    const ID = "id";
    const IMAGE_URL = "image_url";
    const CAPTION = "caption";
    const COUNTRY_ID = "country_id";
    const CANDIDATE_ID = "candidate_id";

    /**
     * unused column
     */
    const USER_ID = "user_id";

    const TABLE = "submission";
    protected $table = self::TABLE;

    public function country(){
        return $this->hasOne(Country::class, Country::ID, self::COUNTRY_ID);
    }

    public function candidate(){
        return $this->hasOne(Candidate::class, Candidate::ID, self::CANDIDATE_ID);
    }

    protected $fillable = [
        self::COUNTRY_ID,
        self::CANDIDATE_ID,
    ];


}

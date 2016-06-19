<?php

namespace App;
//use Codesleeve\Stapler\ORM\StaplerableInterface;
//use Codesleeve\Stapler\ORM\EloquentTrait;

//class Submission extends BaseModel implements StaplerableInterface{
//    use EloquentTrait;
class Submission extends BaseModel{
    const ID = "id";
    const IMAGE_URL = "image_url";
    const CAPTION = "caption";
    const COUNTRY_ID = "country_id";
    const CANDIDATE_ID = "candidate_id";

    const IMAGE_FILE_NAME = "image_file_name";
    const IMAGE_FILE_SIZE = "image_file_size";
    const IMAGE_CONTENT_TYPE = "image_content_type";
    const IMAGE_UPDATED_AT = "image_updated_at";

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

// Add the "image" attachment to the fillable array so that it"s mass-assignable on this model.
    protected $fillable = [
        "image",
        "caption",
        "country_id"
    ];

//    public function __construct(array $attributes = array()){
//        $this->hasAttachedFile("image", [
//            "styles" => [
//                "medium" => "300x300",
//                "thumb" => "100x100"
//            ]
//        ]);
//        parent::__construct($attributes);
//    }


}

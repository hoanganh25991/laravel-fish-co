<?php

namespace App;

class SubmissionImage extends BaseModel{
    const ID = "id";
    const SUBMISSION_ID = "submission_id";
    const IMAGE_ID = "image_id";

    const TABLE = "submission_image";
    protected $table = self::TABLE;

    public function image(){
        return $this->belongsTo(Image::class, self::IMAGE_ID);
    }

    public function submission(){
        return $this->belongsTo(Submission::class, self::SUBMISSION_ID);
    }
}

<?php

namespace App;

class SubmissionImage extends BaseModel{
    const ID = "id";
    const SUBMISSION_ID = "submission_id";
    const IMAGE_ID = "image_id";

    const TABLE = "submission_image";
    protected $table = self::TABLE;
}

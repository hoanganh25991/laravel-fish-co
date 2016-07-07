<?php

namespace App;

use App\Traits\ApiUtil;

class Campaign extends BaseModel{
    use ApiUtil;
    const ID = "id";
    const TITLE = "title";
    const DES = "des";
    const PDF_URL = "pdf_url";

    const TABLE = "campaign";
    protected $table = self::TABLE;
    protected $fillable = [
        "title",
        "description",
        "pdf_url",
        "hashtag",
        "start_at",
        "end_at"
    ];

    public function getEndAtAttribute($value){
        return $this->timestamp($value);
    }
}

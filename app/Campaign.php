<?php

namespace App;

class Campaign extends BaseModel{
    const ID = "id";
    const TITLE = "title";
    const DES = "des";
    const PDF_URL = "pdf_url";

    const TABLE = "campaign";
    protected $table = self::TABLE;
}

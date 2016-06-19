<?php

namespace App;

class Image extends BaseModel{
    const ID = "id";
    const NAME = "name";
    const TYPE = "type";
    const SIZE = "size";
    const PATH = "path";
    const STYLE = "style";

    /**
     * unit: MB
     */
    const MAXIMUM_FILE_SIZE = 6;

    const STYLE_ORIGIN = "origin";
    const STYLE_THUMBNAIl = "thumbnail";
    const STYLE_MEDIUM = "medium";

    const TABLE = "image";
    protected $table = self::TABLE;
}
<?php

namespace App;

class Image extends BaseModel{
    const ID = "id";
    const NAME = "name";
    const TYPE = "type";
    const SIZE = "size";
    const PATH = "path";
    const STYLE = "style";
    const CAPTION = "caption";

    /**
     * unit: Byte
     */
    const MAXIMUM_FILE_SIZE = 20480000;

    const STYLE_ORIGIN = "origin";
    const STYLE_THUMBNAIl = "thumbnail";
    const STYLE_MEDIUM = "medium";

    const TABLE = "image";
    protected $table = self::TABLE;

    protected $fillable = [
        self::NAME,
        self::CAPTION,
        self::TYPE,
        self::SIZE,
        self::STYLE,
        self::PATH,
    ];

    public function setNameAttribute(){
        if(empty($this->attributes[self::CAPTION])){
            /**
             * not need to check on attribute "name"
             */
            if(isset($this->attributes[self::NAME])){
                $this->attributes[self::CAPTION] = $this->attributes[self::NAME];
            }
        }
    }

    public function maxFileSize(){
        return self::MAXIMUM_FILE_SIZE;
    }

    public function isImage($attribute, $value, $parameters, $validator){
        $isImaged = exif_imagetype($value);
        if(!$isImaged){
            return false;
        }
        return true;
    }
}
<?php

namespace App;

use App\Traits\ApiUtil;

class Image extends BaseModel{
    use ApiUtil;
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
        "name",
        "caption",
        "type",
        "size",
        "path",
        "width",
        "height"
    ];
    
    protected $hidden = ["name"];

    public function setNameAttribute($value){
        /** set for it self */
        $this->attributes["name"] = $value;

        /** if caption still null, set for it */
        /** may be caption is later on, set back */
        if(empty($this->attributes["caption"])){
            /**
             * not need to check on attribute "name"
             */
            $this->attributes["caption"] = $value;
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

    public function getPathAttribute($imagePath){
        $link = $this->getUrl($imagePath);
        return $link;
    }

    public static function getUploadDir(){
        return substr(base_path(), 0, strrpos(base_path(), "/")) . DIRECTORY_SEPARATOR . "uploads";
    }
}
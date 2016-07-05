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
        if(!$imagePath){
            return null;
        }
        /**
         * instead of return $this->attributes["path"]
         * return full linkt for device
         * >hostname + /upload/ + filename
         */
//        $uploadFoler = env("UPLOAD_DIRECTORY")? env("UPLOAD_DIRECTORY") : "public/upload";
//        $uploadFolder = self::getUploadDir();
        $relativeLink = substr(url(""), 0, strrpos(url(""), "/")) . "/uploads" . "/" . rawurlencode($imagePath);
//        $realLink = asset($relativeLink);
//        return $realLink;
        return $relativeLink;
    }

    public static function getUploadDir(){
        return substr(base_path(), 0, strrpos(base_path(), "/")) . DIRECTORY_SEPARATOR . "uploads";
    }
}
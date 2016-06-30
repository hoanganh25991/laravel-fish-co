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

    public function getPathAttribute(){
        /**
         * instead of return $this->attributes["path"]
         * return full linkt for device
         * >hostname + /upload/ + filename
         */
        $uploadFoler = env("UPLOAD_DIRECTORY")? env("UPLOAD_DIRECTORY") : "public/upload";
        $relativeLink = $uploadFoler . "/" . $this->attributes["path"];
        $realLink = asset($relativeLink);
        return $realLink;
    }
}
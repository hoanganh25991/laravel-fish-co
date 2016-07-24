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

    public function storeImageInUpload(){
        //move from temp to upload folder
        $imageFile = $_FILES["image"];
        $fileNameWithExt = $imageFile["name"];

        //NO SPACE in file name by md5  */
        $fileName = rawurlencode(pathinfo($fileNameWithExt, PATHINFO_FILENAME));
        $extension = pathinfo($fileNameWithExt, PATHINFO_EXTENSION);
        $fileNameWithExt = "{$fileName}.{$extension}";

        // IF FILE NAME EXIST, run loop while
        $tmpName = $fileName;
        $outputDir = $this->getUploadDir();
        if(!is_dir($outputDir) && !file_exists($outputDir)){
            mkdir($outputDir, 777, true);
        }

        // run loop
        $i = 0;
        while(file_exists($outputDir . "/" . $fileName . "." . $extension)){
            $fileName = "{$tmpName}_{$i}";
            $fileNameWithExt = "{$fileName}.{$extension}";
            $i++;
        }

        $this->path = $fileNameWithExt;

        $imagePath = $outputDir . "/" . $fileNameWithExt;

        $tmpFileMoved = move_uploaded_file($imageFile["tmp_name"], $imagePath);
        if(!$tmpFileMoved){
            throw new \Exception("move image file fail");
        }
        return [
            "file_name" => $fileNameWithExt,
            "image_path" => $imagePath
        ];
    }
}
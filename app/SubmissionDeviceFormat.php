<?php

namespace App;

class SubmissionDeviceFormat{
    public function __construct(Submission $submission){
            $image = $submission->image;
            if($image){
                /** push image-attribute out-into submission */
                $submission->setAttribute("name", $image->name);
                $submission->setAttribute("type", $image->type);
                $submission->setAttribute("size", $image->size);
                $submission->setAttribute("caption", $image->caption);
                $submission->setAttribute("path", $image->path);
                $submission->setAttribute("width", $image->width);
                $submission->setAttribute("height", $image->height);

                /** remove attribute, doesn't want to */
                unset($submission->image);
                return true;
            }
            return false;
    }

}
<?php

namespace App;

class SubmissionDeviceFormat{
    public function __construct(Submission $submission){
            $image = $submission->image;
            if($image){
                /** push image-attribute out-into submission */
//                $submission->setAttribute("name", $image->name);
                $submission->setAttribute("type", $image->type);
                $submission->setAttribute("size", $image->size);
                $submission->setAttribute("caption", $image->caption);
                $submission->setAttribute("path", $image->path);
                $submission->setAttribute("width", $image->width);
                $submission->setAttribute("height", $image->height);

                /** remove attribute, doesn't want to */
            }
            unset($submission->image);

            $likeByDevice = $submission->likeByDevice;
            if($likeByDevice->count() > 0){
                $submission->like_by_device = $likeByDevice->first();
            }
            /* remove attribute */
//            unset($submission->like_by_device);
            unset($submission->likeByDevice);

            $like = $submission->like;
            if($like){
                $submission->like_count = $like->count();
            }
            unset($submission->like);
    }

}
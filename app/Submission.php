<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Submission extends BaseModel{
    protected $table = "submission";
    protected $fillable = [
        "country_id",
    ];
    protected $dates = ["redeeem_at"];

    public function country(){
        return $this->belongsTo(Country::class, "country_id");
    }

    public function candidate(){
        return $this->belongsTo(Candidate::class, "candidate_id");
    }

    public function image(){
        return $this->belongsTo(Image::class, "image_id");
    }

    public function like(){
        return $this->hasMany(Like::class, "submission_id", "id");
    }

    public function likeByDevice(){
        return $this->hasOne(Like::class, "submission_id", "id");
    }

    public function getRedeemAtAttribute($value){
        return $this->timestamp($value);
    }

    public function transformForDevice(){
        $submission = $this;
        if($this->relationLoaded("image")){
            $image = $submission->image;
            /** push image-attribute out-into submission */
//                $submission->setAttribute("name", $image->name);
            $submission->setAttribute("type", $image->type);
            $submission->setAttribute("size", $image->size);
            $submission->setAttribute("caption", $image->caption);
            $submission->setAttribute("path", $image->path);
            $submission->setAttribute("width", $image->width);
            $submission->setAttribute("height", $image->height);

            /** remove attribute */
            unset($submission->image);
        }

        if($this->relationLoaded("likeByDevice")){
            $likeByDevice = $submission->likeByDevice;
            $submission->like_by_device = $likeByDevice;

            /* remove attribute */
            unset($submission->likeByDevice);
        }
    }
}

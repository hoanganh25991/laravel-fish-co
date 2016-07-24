<?php

namespace App;

use App\Traits\ApiUtil;

class Campaign extends BaseModel{
    use ApiUtil;
    const ID = "id";
    const TITLE = "title";
    const DES = "des";
    const PDF_URL = "pdf_url";

    const TABLE = "campaign";
    protected $table = self::TABLE;
    protected $fillable = [
        "title",
        "description",
        "pdf_url",
        "hashtag",
        "start_at",
        "end_at",
        "cover_image"
    ];

    public function getEndAtAttribute($value){
        return $this->timestamp($value);
    }
    
    public function getCoverImageAttribute($filePath){
        return $this->getUrl($filePath);
    }
    
    public function getPdfUrlAttribute($pdfPath){
        $link = $this->getUrl($pdfPath);
        return $link;
    }
    
    public function submission(){
        return $this->hasMany(Submission::class, "campaign_id", "id");
    }

    public function getStartAtAttribute($value){
        return $this->timestamp($value);
    }
    
    public function scopeSubmissionCount($query){
        return $query
            ->selectRaw("campaign.*, count(submission.id) as submission_count")
            ->leftJoin("submission", "submission.campaign_id", "=", "campaign.id")
            ->groupBy("campaign.id");
    }
}

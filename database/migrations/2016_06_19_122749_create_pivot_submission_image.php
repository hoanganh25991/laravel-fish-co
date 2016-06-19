<?php

use App\SubmissionImage;
use App\Submission;
use App\Image;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotSubmissionImage extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create(SubmissionImage::TABLE, function (Blueprint $table){
            $table->increments(SubmissionImage::ID);
            $table->unsignedInteger(SubmissionImage::SUBMISSION_ID);
            $table->unsignedInteger(SubmissionImage::IMAGE_ID);

            $table->foreign(SubmissionImage::SUBMISSION_ID)->references(Submission::ID)->on(Submission::TABLE);
            $table->foreign(SubmissionImage::IMAGE_ID)->references(Image::ID)->on(Image::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table(SubmissionImage::TABLE, function (Blueprint $table){
            $sI = new SubmissionImage();
            $table->dropForeign($sI->getForeignKeyAt(SubmissionImage::IMAGE_ID));
            $table->dropForeign($sI->getForeignKeyAt(SubmissionImage::SUBMISSION_ID));
        });
        Schema::drop(SubmissionImage::TABLE);
    }
}

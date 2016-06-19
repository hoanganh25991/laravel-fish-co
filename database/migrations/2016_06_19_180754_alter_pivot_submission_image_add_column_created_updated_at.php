<?php

use App\SubmissionImage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPivotSubmissionImageAddColumnCreatedUpdatedAt extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table(SubmissionImage::TABLE, function (Blueprint $table){
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table(SubmissionImage::TABLE, function (Blueprint $table){
            $table->dropColumn("updated_at");
            $table->dropColumn("created_at");
        });
    }
}

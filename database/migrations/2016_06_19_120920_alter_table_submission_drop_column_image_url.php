<?php

use App\Submission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSubmissionDropColumnImageUrl extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table(Submission::TABLE, function(Blueprint $table){
            $table->dropColumn(Submission::IMAGE_URL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table(Submission::TABLE, function(Blueprint $table){
            $table->mediumText(Submission::IMAGE_URL);
        });
    }
}

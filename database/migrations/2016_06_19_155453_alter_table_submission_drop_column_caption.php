<?php

use App\Submission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSubmissionDropColumnCaption extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table(Submission::TABLE, function (Blueprint $table){
            $table->dropColumn(Submission::CAPTION);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table(Submission::TABLE, function (Blueprint $table){
            $table->string(Submission::CAPTION);
        });
    }
}

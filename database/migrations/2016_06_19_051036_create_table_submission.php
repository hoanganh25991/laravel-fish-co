<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Submission;

class CreateTableSubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Submission::TABLE, function (Blueprint $table) {
            $table->increments(Submission::ID);
            $table->timestamps();
            $table->string(Submission::CAPTION);
            $table->mediumText(Submission::IMAGE_URL);
            $table->unsignedInteger(Submission::COUNTRY_ID);
            $table->unsignedInteger(Submission::CANDIDATE_ID);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Submission::TABLE);
    }
}

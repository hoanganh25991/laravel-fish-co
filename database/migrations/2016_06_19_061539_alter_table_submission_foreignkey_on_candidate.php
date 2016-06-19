<?php

use App\Candidate;
use App\Country;
use App\Submission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSubmissionForeignkeyOnCandidate extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table(Submission::TABLE, function (Blueprint $table){
            $table->dropColumn(Submission::USER_ID);
            $table->unsignedInteger(Submission::CANDIDATE_ID);
            $table->foreign(Submission::CANDIDATE_ID)->references(Candidate::ID)->on(Candidate::TABLE);
            $table->foreign(Submission::COUNTRY_ID)->references(Country::ID)->on(Country::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table(Submission::TABLE, function (Blueprint $table){
            $submission = new Submission();
            $table->dropForeign($submission->getForeignKeyAt(Submission::COUNTRY_ID));
            $table->dropForeign($submission->getForeignKeyAt(Submission::CANDIDATE_ID));
            $table->dropColumn(Submission::CANDIDATE_ID);
            $table->unsignedInteger(Submission::USER_ID);
        });
    }
}

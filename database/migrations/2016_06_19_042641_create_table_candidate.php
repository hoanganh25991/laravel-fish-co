<?php

use App\Candidate;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCandidate extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create(Candidate::TABLE, function (Blueprint $table){
            $table->increments(Candidate::ID);
            $table->timestamps();
            $table->string(Candidate::NAME);
            $table->string(Candidate::EMAIL);
            $table->string(Candidate::CONTACT_NUMBER)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop(Candidate::TABLE);
    }
}

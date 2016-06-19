<?php

use App\Country;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCountry extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create(Country::TABLE, function (Blueprint $table){
            $table->increments(Country::ID);
            $table->timestamps();
            $table->string(Country::NAME)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop(Country::TABLE);
    }
}

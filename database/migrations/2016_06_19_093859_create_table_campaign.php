<?php

use App\Campaign;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCampaign extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create(Campaign::TABLE, function (Blueprint $table){
            $table->increments(Campaign::ID);
            $table->timestamps();
            $table->string(Campaign::TITLE);
            $table->mediumText(Campaign::DES);
            $table->mediumText(Campaign::PDF_URL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop(Campaign::TABLE);
    }
}

<?php

use App\Image;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableImage extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create(Image::TABLE, function(Blueprint $table){
            $table->increments(Image::ID);
            $table->string(Image::NAME)->unique();
            $table->string(Image::TYPE);
            $table->string(Image::STYLE)->default(Image::STYLE_ORIGIN);
            $table->unsignedTinyInteger(Image::SIZE);
            $table->mediumText(Image::PATH);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop(Image::TABLE);
    }
}

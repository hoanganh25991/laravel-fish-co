<?php

use App\Image;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableImageDropUniqueName extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table(Image::TABLE, function (Blueprint $table){
            $image = new Image();
            $table->dropUnique($image->getUniqueIndexAt(Image::NAME));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table(Image::TABLE, function (Blueprint $table){
            $table->unique(Image::NAME);
        });
    }
}

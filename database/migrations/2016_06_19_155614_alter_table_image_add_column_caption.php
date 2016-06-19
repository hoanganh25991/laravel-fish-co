<?php

use App\Image;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableImageAddColumnCaption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(Image::TABLE, function(Blueprint $table){
            $table->string(Image::CAPTION);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(Image::TABLE, function(Blueprint $table){
            $table->dropColumn(Image::CAPTION);
        });
    }
}

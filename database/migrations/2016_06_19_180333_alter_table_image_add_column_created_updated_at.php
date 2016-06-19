<?php

use App\Image;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableImageAddColumnCreatedUpdatedAt extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table(Image::TABLE, function (Blueprint $table){
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table(Image::TABLE, function (Blueprint $table){
            $table->dropColumn("updated_at");
            $table->dropColumn("created_at");
        });
    }
}

<?php

use App\Image;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableImageChangeColumnSizeType extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table(Image::TABLE, function (Blueprint $table){
//            $table->dropColumn(Image::SIZE);
//            $table->unsignedInteger(Image::SIZE)->after(Image::SIZE);
            /**
             * drop column & create column
             * base on async task > error
             * USING change() to modify
             */
            $table->unsignedInteger(Image::SIZE)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table(Image::TABLE, function (Blueprint $table){
//            $table->dropColumn(Image::SIZE);
//            $table->tinyInteger(Image::SIZE);
            /**
             * error, tinyInteger NOT DEFINE by doctrine dball
             * HOW CAN I re-define it
             */
//            $table->tinyInteger(Image::SIZE)->change();
            /**
             * also error on mediumInterger
             */
//            $table->mediumInteger(Image::SIZE)->change();
            /**
             * work around by RAW DB statement
             */
            $image = new Image();
            $columnSize = Image::SIZE;
            DB::statement("ALTER TABLE {$image->getTable()} CHANGE {$columnSize} {$columnSize} TINYINT(3) UNSIGNED NULL DEFAULT NULL;");
        });
    }
}

<?php

use App\Device;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDevice extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create(Device::TABLE, function (Blueprint $table){
            $table->increments(Device::ID);
            $table->timestamps();
            $table->string(Device::SERIAL_NUMBER)->unique();
            $table->mediumText(Device::DES);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop(Device::TABLE);
    }
}

<?php

use App\Candidate;
use App\Device;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDeviceForeignkeyOnCandidate extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table(Device::TABLE, function (Blueprint $table){
            $table->unsignedInteger(Device::CANDIDATE_ID);
            $table->foreign(Device::CANDIDATE_ID)->references(Candidate::ID)->on(Candidate::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table(Device::TABLE, function (Blueprint $table){
            $device = new Device();
            $table->dropForeign($device->getForeignKeyAt(Device::CANDIDATE_ID));
            $table->dropColumn(Device::CANDIDATE_ID);
        });
    }
}

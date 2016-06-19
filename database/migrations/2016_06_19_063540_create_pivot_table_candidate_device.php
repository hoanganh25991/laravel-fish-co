<?php

use App\Candidate;
use App\CandidateDevice;
use App\Device;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTableCandidateDevice extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create(CandidateDevice::TABLE, function (Blueprint $table){
            $table->increments(CandidateDevice::ID);
            $table->timestamps();
            $table->unsignedInteger(CandidateDevice::CANDIDATE_ID);
            $table->unsignedInteger(CandidateDevice::DEVICE_ID);

            $table->foreign(CandidateDevice::CANDIDATE_ID)->references(Candidate::ID)->on(Candidate::TABLE);
            $table->foreign(CandidateDevice::DEVICE_ID)->references(Device::ID)->on(Device::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table(CandidateDevice::TABLE, function (Blueprint $table){
            $candidateDevice = new CandidateDevice();
            $table->dropForeign($candidateDevice->getForeignKeyAt(CandidateDevice::DEVICE_ID));
            $table->dropForeign($candidateDevice->getForeignKeyAt(CandidateDevice::CANDIDATE_ID));
        });
        Schema::drop(CandidateDevice::TABLE);
    }
}

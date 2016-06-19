<?php

use App\Country;
use App\Store;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableStore extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create(Store::TABLE, function (Blueprint $table){
            $table->increments(Store::ID);
            $table->timestamps();
            $table->string(Store::NAME);
            $table->string(Store::ADDRESS)->unique();
            $table->string(Store::TEL);
            $table->unsignedInteger(Store::COUNTRY_ID);

            $table->foreign(Store::COUNTRY_ID)->references(Country::ID)->on(Country::TABLE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        /** @var Store $store */
        $store = new Store();
        Schema::table(Store::TABLE, function (Blueprint $table) use($store){
            $table->dropForeign($store->getForeignKeyAt(Store::COUNTRY_ID));
        });
        Schema::drop(Store::TABLE);
    }
}

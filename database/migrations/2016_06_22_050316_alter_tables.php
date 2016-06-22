<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Device;
use App\Submission;
use App\Image;

class AlterTables extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        /**
         * alter table device
         */
        Schema::table("device", function (Blueprint $table){
            $table->renameColumn("serial_number", "uuid");
            $table->renameColumn("des", "description");
            $table->string("os");
            $table->string("os_ver");
            $table->string("app_ver");
            $table->string("model");
            $table->string("manufacturer");
            $table->dateTime("last_access");
        });

        /**
         * alter table campaign
         */
        Schema::table("campaign", function (Blueprint $table){
            $table->dateTime("end_at");
            $table->string("slug");
            $table->boolean("active")->default(true);
        });

        /**
         * alter table country
         */
        Schema::table("country", function (Blueprint $table){
            $table->string("country_code", 2);

            /** net work */
            $table->string("instagram_url");
            $table->string("website_url");
            $table->string("facebook_url");
            $table->string("twitter_url");
        });

        /**
         * create table region
         * country > region (East, West,..) > Outlet
         */
        Schema::create("region", function (Blueprint $table){
            $table->increments("id");
            $table->timestamps();
            $table->string("name");

            /** foreign to country id */
            $table->unsignedInteger("country_id");
            $table->foreign("country_id")->references("id")->on("country");

            /** net work */
            $table->string("instagram_url");
            $table->string("website_url");
            $table->string("facebook_url");
            $table->string("twitter_url");
        });

        /**
         * alter table store > outlet
         */
        Schema::rename("store", "outlet");

        /**
         * after succes rename store > outlet
         * add column
         */
        Schema::table("outlet", function(Blueprint $table){
            $table->unsignedInteger("region_id");
            $table->dropForeign("store_country_id_foreign");
            $table->foreign("region_id")->references("id")->on("region")->after("region_id");

            /** net work */
            $table->string("instagram_url");
            $table->string("website_url");
            $table->string("facebook_url");
            $table->string("twitter_url");
        });

        /**
         * alter table submission
         */
        Schema::table("submission", function (Blueprint $table){
            /** allow admin hide "not-good" submission */
            $table->boolean("active")->default(true);

            /** redeem */
            $table->string("redeem_uuid");
            $table->dateTime("redeem_at");

            /** image, submission---1-image */
            $table->unsignedInteger("image_id");
            $table->foreign("image_id")->references("id")->on("image");
        });

        /**
         * alter table image
         */
        Schema::table("image", function(Blueprint $table){
            $table->unsignedSmallInteger("width");
            $table->unsignedSmallInteger("height");
            
            $table->dropColumn("style");
        });

        /**
         * create table like
         * like on submission
         * like-*---submission
         */
        Schema::create("like", function (Blueprint $table){
            $table->increments("id");
            $table->timestamps();

            /* like */
            $table->unsignedInteger("submission_id");
            $table->foreign("submission_id")->references("id")->on("submission");

            /* recognize who submit it
            store (candidate, device) */
            $table->unsignedInteger("device_id");
            $table->foreign("device_id")->references("id")->on("device");

            $table->unsignedInteger("candidate_id");
            $table->foreign("candidate_id")->references("id")->on("candidate");
        });
        
        /**
         * drop table
         */
        Schema::drop("submission_image");
        Schema::drop("candidate_device");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        //
    }
}

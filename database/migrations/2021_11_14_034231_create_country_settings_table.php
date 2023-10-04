<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountrySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->foreignId('company_id');
            $table->boolean('is_special_price')->default('0');
            $table->float('parcel_base_price');
            $table->integer('parcel_hike_price');
            $table->integer('letters_base_price');
            $table->integer('letters_hike_price');
            $table->integer('documents_base_price');
            $table->integer('documents_hike_price');
            $table->integer('goods_base_price');
            $table->integer('goods_hike_price');
            $table->string('delivery_days');
            $table->integer('parcelPost_capacity');
            $table->integer('letterPost_capacity');
            $table->integer('country_parcel_weight_slot')->nullable();
            $table->integer('country_letters_weight_slot')->nullable();
            $table->integer('country_documents_weight_slot')->nullable();
            $table->integer('country_goods_weight_slot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_settings');
    }
}

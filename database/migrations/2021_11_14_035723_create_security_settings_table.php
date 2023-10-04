<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecuritySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('security_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('registeredParcel_price');
            $table->integer('insuranceBase_price');
            $table->integer('insurancePrice_slot');
            $table->integer('maximumInsurance_coverage');
            $table->integer('insurancePrice_hike_per_slot');
            $table->integer('ekshop_parcel_charge')->nullable();
            $table->integer('ekshop_letter_charge')->nullable();
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
        Schema::dropIfExists('security_settings');
    }
}

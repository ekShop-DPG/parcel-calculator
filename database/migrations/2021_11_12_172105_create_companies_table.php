<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company_shortcode')->unique();
            $table->string('company_logo')->nullable();
            $table->string('bg_image')->nullable()->default('default_image.png');
            $table->string('bg_color')->nullable()->default('#e9ecef');
            $table->integer('parcel_weight_slot');
            $table->integer('letters_weight_slot');
            $table->integer('documents_weight_slot');
            $table->integer('goods_weight_slot');
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
        Schema::dropIfExists('companies');
    }
}

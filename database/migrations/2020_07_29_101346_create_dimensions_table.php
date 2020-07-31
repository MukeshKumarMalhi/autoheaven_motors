<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDimensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dimensions', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('car_id')->nullable();
          $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade')->onUpdate('cascade');
          $table->string('height')->nullable();
          $table->string('height_inclusive_of_roof_rails')->nullable();
          $table->string('length')->nullable();
          $table->string('wheelbase')->nullable();
          $table->string('width')->nullable();
          $table->string('width_including_mirrors')->nullable();
          $table->string('fuel_tank_capacity')->nullable();
          $table->string('minimum_kerb_weight')->nullable();
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
        Schema::dropIfExists('dimensions');
    }
}

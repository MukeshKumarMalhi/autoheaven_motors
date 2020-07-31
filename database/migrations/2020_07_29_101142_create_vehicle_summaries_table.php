<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_summaries', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('car_id')->nullable();
          $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade')->onUpdate('cascade');
          $table->string('co2_emissions')->nullable();
          $table->string('insurance_group')->nullable();
          $table->string('standard_manufacturers_warranty_miles')->nullable();
          $table->string('standard_manufacturers_warranty_years')->nullable();
          $table->string('standard_paintwork_guarantee')->nullable();
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
        Schema::dropIfExists('vehicle_summaries');
    }
}

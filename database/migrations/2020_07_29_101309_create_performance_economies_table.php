<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceEconomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_economies', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('car_id')->nullable();
          $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade')->onUpdate('cascade');
          $table->string('fuel_consumption_urban')->nullable();
          $table->string('fuel_consumption_extra_urban')->nullable();
          $table->string('fuel_consumption_combined')->nullable();
          $table->string('0_60_mph')->nullable();
          $table->string('top_speed')->nullable();
          $table->integer('cylinders')->nullable();
          $table->integer('valves')->nullable();
          $table->integer('engine_power')->nullable();
          $table->integer('engine_torque')->nullable();
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
        Schema::dropIfExists('performance_economies');
    }
}

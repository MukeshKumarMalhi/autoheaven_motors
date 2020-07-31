<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellYourVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_your_vehicles', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->enum('vehicle_type', ['car', 'bike', 'van', 'carvan', 'motorhome'])->nullable();
          $table->string('company')->nullable();
          $table->string('model')->nullable();
          $table->string('vehicle_reg')->nullable();
          $table->string('mileage')->nullable();
          $table->enum('service_history', ['full_service_history', 'partial_service_history', 'first_service_not_due', 'no_service_history'])->nullable();
          $table->text('vehicle_come_with_specify')->nullable();
          $table->enum('vehicle_condition', ['no', 'minor', 'medium', 'major', 'needs_replacement'])->nullable();
          $table->text('vehicle_damage_condition_description')->nullable();
          $table->string('full_name')->nullable();
          $table->string('phone_number')->nullable();
          $table->string('email_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_your_vehicles');
    }
}

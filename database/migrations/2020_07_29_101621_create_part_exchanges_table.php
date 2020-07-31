<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_exchanges', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->enum('vehicle_type', ['car', 'bike', 'van', 'carvan', 'motorhome'])->nullable();
          $table->string('company')->nullable();
          $table->string('model')->nullable();
          $table->string('vehicle_reg')->nullable();
          $table->string('mileage')->nullable();
          $table->string('condition')->nullable();
          $table->string('full_name')->nullable();
          $table->string('phone_number')->nullable();
          $table->string('email_address')->nullable();
          $table->enum('best_time_to_call', ['morning', 'afternoon', 'evening'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('part_exchanges');
    }
}

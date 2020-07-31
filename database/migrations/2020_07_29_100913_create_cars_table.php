<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('category_id')->nullable();
          $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
          $table->string('name')->nullable();
          $table->string('model')->nullable();
          $table->string('model_year')->nullable();
          $table->string('colour')->nullable();
          $table->integer('price')->default(0);
          $table->integer('mileage')->default(0);
          $table->integer('number_of_doors')->default(0);
          $table->integer('number_of_seats')->default(0);
          $table->decimal('engine_size', 10, 1)->default(0.0);
          $table->string('body_style')->nullable();
          $table->text('description')->nullable();
          $table->enum('fuel_type', ['petrol', 'diesel'])->nullable();
          $table->enum('gearbox_type', ['automatic', 'manual'])->nullable();
          $table->enum('car_type', ['used', 'new'])->nullable();
          $table->enum('status', ['activated', 'deactivated'])->default('activated');
          $table->enum('sale_status', ['sold', 'on_sale'])->nullable();
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
        Schema::dropIfExists('cars');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_enquiries', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->string('car_id')->nullable();
          $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade')->onUpdate('cascade');
          $table->string('name')->nullable();
          $table->string('phone')->nullable();
          $table->string('email')->nullable();
          $table->text('info_message')->nullable();
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
        Schema::dropIfExists('car_enquiries');
    }
}

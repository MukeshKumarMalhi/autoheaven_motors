<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
          $table->engine="InnoDB";
          $table->string('id')->primary();
          $table->integer('rating_number')->nullable();
          $table->string('rating_title')->nullable();
          $table->text('rating_desc')->nullable();
          $table->string('full_name')->nullable();
          $table->string('email')->nullable();
          $table->boolean('confirm')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}

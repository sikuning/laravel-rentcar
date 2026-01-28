<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_inventories', function (Blueprint $table) {
            $table->id('car_id');
            $table->string('car_name',255);
            $table->string('car_slug',255);
            $table->text('car_descr');
            $table->integer('price');
            $table->integer('car_type');
            $table->integer('fuel_type');
            $table->integer('mileage');
            $table->integer('model_year');
            $table->integer('transmission');
            $table->integer('passengers');
            $table->integer('doors');
            $table->integer('bags');
            $table->string('car_image');
            $table->string('extras')->nullable();
            $table->integer('status')->default('1');
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
        Schema::dropIfExists('car_inventories');
    }
}

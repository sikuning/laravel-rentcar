<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('pick_date',15);
            $table->string('pick_time',15);
            $table->string('return_date',15);
            $table->string('return_time',15);
            $table->integer('pic_loc');
            $table->integer('return_loc');
            $table->integer('car_id');
            $table->integer('user_id');
            $table->string('pay_method',100);
            $table->string('pay_id',100);
            $table->string('total_amount',100);
            $table->string('advance_amount',100);
            $table->string('pay_status');
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
        Schema::dropIfExists('bookings');
    }
}

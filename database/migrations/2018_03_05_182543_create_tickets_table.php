<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('price')->unsigned();
            $table->integer('trip_id')->unsigned();
            $table->integer('personality_id')->unsigned();
            $table->integer('passenger_id')->unsigned()->nullable();    // id of account using which the ticket was bought
            $table->integer('seat_id')->unsigned()->unique()->nullable();
            $table->integer('promo_code_id')->unsigned()->nullable()->unique();
            $table->string('qr_code', 32)->unique();
            $table->timestampTz('boarded_at')->nullable();
            $table->boolean('returned')->default(false);
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
        Schema::dropIfExists('tickets');
    }
}

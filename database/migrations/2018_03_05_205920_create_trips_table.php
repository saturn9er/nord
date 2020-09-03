<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route_id')->unsigned();
            $table->date('date');
            $table->smallInteger('price')->unsigned();
            $table->timeTz('actual_departure')->nullable();
            $table->timeTz('actual_arrival')->nullable();
            $table->string('departure_gate', 4)->nullable();
            $table->string('destination_gate', 4)->nullable();
            $table->integer('bus_id')->unsigned()->nullable();
            $table->string('passcode', 6);
            $table->smallInteger('seats_left')->unsigned();
            $table->integer('status_id')->unsigned()->default(1);
            $table->time('status_time')->nullable();
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
        Schema::dropIfExists('rides');
    }
}

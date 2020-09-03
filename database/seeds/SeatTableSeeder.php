<?php

use Illuminate\Database\Seeder;
use App\Trip;
use App\Seat;
use App\Status;

class SeatTableSeeder extends Seeder
{
    /**
     * Creates seats for each trip having no mention in seats table
     *
     * Warning: Discourage to use on big trips tables!
     *
     * @return void
     */
    public function run()
    {
        $trips = Trip::all('id', 'status_id', 'seats_left');
        $timestamp  = date("Y-m-d H:i:s");

        foreach ($trips as $trip)
        {
            if((Seat::where('trip_id', $trip->id)->first()) || ($trip->status_id == Status::CANCELLED)) continue;

            $seats = array();

            for($i = 0; $i < $trip->seats_left; $i++)
            {
                array_push($seats, ['name' => $i + 1, 'trip_id' => $trip->id, 'created_at' => $timestamp]);
            }

            DB::table('seats')->insert($seats);
        }

    }
}

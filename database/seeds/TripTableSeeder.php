<?php

use Illuminate\Database\Seeder;
use App\Route as Route;

class TripTableSeeder extends Seeder
{
    /**
     * Creates trips for all routes on a particular date
     *
     * @return void
     */
    public function run()
    {
        $trips = array();
        $timestamp      = date("Y-m-d H:i:s");
        $date           = new DateTime();
        $date->add(new DateInterval('P14D')); //adds 14 days to current date
        $date           = $date->format('Y-m-d');
        //$date         = '2018-05-03';
        $routes         = Route::all('id');
        $seats          = 82;

        foreach($routes as $route)
        {
            $route_id   = $route->id;
            $price      = rand(300, 600);
            $passcode   = str_random(6);

            array_push($trips, ['route_id' => $route_id, 'date' => $date, 'price' => $price, 'passcode' => $passcode, 'seats_left' => $seats, 'created_at' => $timestamp]);
        }

        DB::table('trips')->insert($trips);
    }
}

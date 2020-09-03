<?php

use Illuminate\Database\Seeder;
use App\Trip;
use App\Route;
class TripStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = '2018-05-01';
        $time = new DateTime($date);
        $time->setTimezone(new DateTimeZone(config('app.timezone')));
        $time->format('Y-m-d H:i:s');

        $trips = Trip::select('id', 'route_id')->where('date', '=', $date)->get();

        foreach ($trips as $trip)
        {
            $route = Route::select('departure_time', 'arrival_time')->where('id', $trip->route_id)->first();
            $timeArray = (explode(":", $route->departure_time));
            $actualDeparture = clone $time;
            $actualDeparture->setTime($timeArray[0], $timeArray[1]);
            $actualDeparture->format('Y-m-d H:i:s');
            $randomTimeDisplacement = random_int(0, 30);
            $actualDeparture = $actualDeparture->modify('+'.$randomTimeDisplacement.' minutes');

            $timeArray = (explode(":", $route->arrival_time));
            $actualArrival = clone $time;
            $actualArrival->setTime($timeArray[0], $timeArray[1]);
            $actualArrival->format('Y-m-d H:i:s');
            $randomTimeDisplacement = random_int(-25, 25);
            $actualArrival = $actualArrival->modify('+'.$randomTimeDisplacement.' minutes');
            $trip->actual_departure = $actualDeparture;
            $trip->actual_arrival = $actualArrival;
            $trip->departure_gate = random_int(1, 10);
            $trip->destination_gate = random_int(1, 10);
            $trip->status_id = 5;
            $trip->status_time = $actualArrival->format('H:i:s');
            $trip->save();
        }

    }
}

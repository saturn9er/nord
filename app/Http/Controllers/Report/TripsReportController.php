<?php

namespace App\Http\Controllers\Report;

use App\Status;
use App\Http\Controllers\Controller;
use App\Trip;
use Illuminate\Support\Facades\DB;

class TripsReportController extends Controller
{
    public function __invoke($date = null)
    {
        if(is_null($date)){
            $date = new \DateTime('today');
            $date = new \DateTime('2018-05-01');
            $date->format('Y-m-d');
        } else {
            $date = new \DateTime($date);
        }

        $tripsArrivedLater = Trip::join('routes', 'routes.id', 'trips.route_id')
            ->where(DB::raw('TIMESTAMPDIFF(MINUTE, routes.arrival_time, trips.actual_arrival)'), '>', '10')
            ->where('trips.status_id', Status::ARRIVED)
            ->where('trips.date', $date)
            ->count();

        $tripsArrivedInTime = Trip::join('routes', 'routes.id', 'trips.route_id')
            ->whereBetween(DB::raw('TIMESTAMPDIFF(MINUTE, routes.arrival_time, trips.actual_arrival)'), array(-10, 10))
            ->where('trips.status_id', Status::ARRIVED)
            ->where('trips.date', $date)
            ->count();

        $tripsArrivedEarlier = Trip::join('routes', 'routes.id', 'trips.route_id')
            ->where(DB::raw('TIMESTAMPDIFF(MINUTE, routes.arrival_time, trips.actual_arrival)'), '<', '-10')
            ->where('trips.status_id', Status::ARRIVED)
            ->where('trips.date', $date)
            ->count();

        $tripsCancelled = Trip::where('trips.status_id', Status::CANCELLED)
            ->where('trips.date', $date)
            ->count();

        $date = $date->format('d-m-Y');

        return view('agent.reports.trips')->with(compact('tripsArrivedLater', 'tripsArrivedInTime', 'tripsArrivedEarlier', 'tripsCancelled', 'date'));
    }
}

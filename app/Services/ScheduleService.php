<?php
/**
 * Created by IntelliJ IDEA.
 * User: marshall
 * Date: 15/03/2018
 * Time: 8:05 PM
 */

namespace App\Services;
use App\Trip;


class ScheduleService
{
    public static function getArrivalsByTerminalID($terminalID, $dates)
    {
        return Trip::select('routes.name as route_name', 'trips.date', 'departure.short_name as departure', 'routes.arrival_time', 'trips.status_id',  'trips.status_time')
            ->join('routes', 'routes.id', '=', 'trips.route_id')
            ->join('terminals as departure', 'departure.id', '=', 'routes.departure')
            ->where('routes.destination', $terminalID)
            ->whereIn('trips.date', $dates)
            ->orderBy('trips.date')
            ->orderBy('routes.arrival_time')
            ->get();
    }

    public static function getDeparturesByTerminalID($terminalID, $dates)
    {
        return Trip::select('routes.name as route_name', 'trips.date', 'destination.short_name as destination', 'routes.departure_time', 'trips.actual_departure', 'trips.status_id',  'trips.status_time')
            ->join('routes', 'routes.id', '=', 'trips.route_id')
            ->join('terminals as destination', 'destination.id', '=', 'routes.destination')
            ->where('routes.departure', $terminalID)
            ->whereIn('trips.date', $dates)
            ->orderBy('trips.date')
            ->orderBy('routes.departure_time')
            ->get();
    }
}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: marshall
 * Date: 01/04/2018
 * Time: 1:03 PM
 */

namespace App\Services;


use App\Status;
use App\Trip;

class TripService
{
    public static function getActiveArrivalsByTerminalID($terminalID)
    {
        return Trip::select('trips.id as trip_id', 'routes.name as route_name', 'trips.date', 'departure.short_name as departure', 'routes.arrival_time', 'trips.actual_departure', 'buses.plate_number', 'buses.latitude', 'buses.longitude', 'trips.seats_left', 'trips.status_id',  'trips.status_time')
            ->join('routes', 'routes.id', '=', 'trips.route_id')
            ->join('terminals as departure', 'departure.id', '=', 'routes.departure')
            ->leftJoin('buses', 'buses.id', '=', 'trips.bus_id')
            ->where('routes.destination', $terminalID)
            ->whereIn('trips.status_id', [Status::SCHEDULED, Status::DELAYED, Status::BOARDING, Status::DEPARTED])
            ->orderBy('trips.date')
            ->orderBy('routes.arrival_time')
            ->get();
    }

    public static function getActiveDeparturesByTerminalID($terminalID)
    {
        return Trip::select('trips.id as trip_id', 'routes.name as route_name', 'trips.date', 'destination.short_name as destination', 'routes.departure_time', 'trips.actual_departure', 'buses.plate_number', 'buses.latitude', 'buses.longitude', 'trips.seats_left', 'trips.status_id',  'trips.status_time')
            ->join('routes', 'routes.id', '=', 'trips.route_id')
            ->join('terminals as destination', 'destination.id', '=', 'routes.destination')
            ->leftJoin('buses', 'buses.id', '=', 'trips.bus_id')
            ->where('routes.departure', $terminalID)
            ->whereIn('trips.status_id', [Status::SCHEDULED, Status::DELAYED, Status::BOARDING, Status::DEPARTED])
            ->orderBy('trips.date')
            ->orderBy('routes.departure_time')
            ->get();
    }

    public static function getTripByID($tripID)
    {
        return Trip::select('trips.id', 'routes.name as route_name', 'trips.date', 'departure.short_name as departure', 'destination.short_name as destination', 'trips.price', 'routes.departure_time', 'routes.arrival_time', 'trips.actual_departure', 'trips.actual_arrival', 'trips.bus_id', 'buses.plate_number', 'buses.seats', 'trips.passcode', 'trips.status_id', 'trips.status_time')
            ->join('statuses', 'statuses.id', '=', 'trips.status_id')
            ->join('routes', 'routes.id', '=', 'trips.route_id')
            ->leftJoin('buses', 'buses.id', '=', 'trips.bus_id')
            ->join('terminals as departure', 'departure.id', '=', 'routes.departure')
            ->join('terminals as destination', 'destination.id', '=', 'routes.destination')
            ->where('trips.id', $tripID)
            ->first();
    }
}
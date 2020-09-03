<?php

namespace App\Http\Controllers\Trip;

use Illuminate\Http\Request;
use App\Services\TripService as Service;
use App\Http\Controllers\Controller;

class ActiveTripController extends Controller
{
    public function __invoke($terminalID = 1)
    {
        $arrivals = Service::getActiveArrivalsByTerminalID($terminalID);
        $departures = Service::getActiveDeparturesByTerminalID($terminalID);
        return view('agent.trips.active')->with(compact('arrivals', 'departures', 'terminalID'));
    }
}

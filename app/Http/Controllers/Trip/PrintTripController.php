<?php

namespace App\Http\Controllers\Trip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TripService as Service;

class PrintTripController extends Controller
{
    public function __invoke($id)
    {
        $trip = Service::getTripByID($id);
        return view('agent.trips.print')->with(compact('trip'));
    }
}

<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Services\ScheduleService as Service;

class ScheduleController extends Controller
{
    public function show($terminalID = 1)
    {
        $yesterday = new DateTime('yesterday');
        $yesterday = new DateTime('2018-05-01');
        $yesterday = $yesterday->format('Y-m-d');

        $today = new DateTime('today');
        $today = new DateTime('2018-05-02');
        $today = $today->format('Y-m-d');

        $tomorrow = new DateTime('tomorrow');
        $tomorrow = new DateTime('2018-05-03');
        $tomorrow = $tomorrow->format('Y-m-d');

        $dates = [$yesterday, $today, $tomorrow];

        $arrivals = Service::getArrivalsByTerminalID($terminalID, $dates);

        $departures = Service::getDeparturesByTerminalID($terminalID, $dates);

        if (Auth::guard('agent')->check()) {
            return view('agent.schedule')->with(compact('terminalID', 'arrivals', 'departures'));
        }
        elseif (Auth::guard('driver')->check())
        {
            return view('driver.schedule')->with(compact('terminalID', 'arrivals', 'departures'));
        }
        elseif (Auth::guard('cashier')->check())
        {
            return view('cashier.schedule')->with(compact('terminalID', 'arrivals', 'departures'));
        }

        return view('passenger.schedule')->with(compact('terminalID', 'arrivals', 'departures'));
    }
}

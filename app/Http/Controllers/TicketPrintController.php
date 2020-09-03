<?php

namespace App\Http\Controllers;

use App\Services\LocationService as Location;
use Illuminate\Support\Facades\Auth;
use App\Services\TicketService as Service;

class TicketPrintController extends Controller
{
    public function show($id)
    {
        $passengerID = Auth::id();
        $ticket = Service::getTicketByTicketID($id);
        $location = Location::implodeLocation($ticket->location);
        if(($ticket->passenger_id = $passengerID) && ($ticket->returned == 0))
        {
            return view('ticket.print')->with(compact('ticket', 'location'));
        }

        abort(404);
    }
}

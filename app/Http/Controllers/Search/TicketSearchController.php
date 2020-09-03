<?php

namespace App\Http\Controllers\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Terminal;


class TicketSearchController extends Controller
{
    public function index(Request $request)
    {
        $terminals = Terminal::all('id', 'short_name');
        if (Auth::guard('cashier')->check())
        {
            return view('cashier.search')->with(compact('terminals', 'slug'));
        }
        return view('passenger.search')->with(compact('terminals', 'slug'));
    }

    public function search(Request $request)
    {
        $validation = $request->validate([
            'departure'     => 'required|numeric',
            'destination'   => 'required|numeric',
            'date'          => 'required|date',
            'passengers'    => 'required|numeric'
        ]);

        $departure      = $request->departure;
        $destination    = $request->destination;
        $date           = date('Y-m-d', strtotime($request->date));
        $passengers     = $request->passengers;

        $tickets = DB::select('select routes.name as route, routes.dep as departure, routes.dest as destination, routes.departure_time, routes.arrival_time, trips.id as trip_id, trips.date, trips.price, trips.seats_left 
                           from trips, ( select routes.id, routes.name, routes.departure_time, routes.arrival_time, routes.departure, routes.destination, departure.name as dep, destination.name as dest
                                         from routes 
                                         inner join terminals as departure on routes.departure = departure.id 
                                         inner join terminals as destination on routes.destination = destination.id 
                                         order by routes.departure, routes.destination) as routes 
                           where routes.id = trips.route_id and routes.departure = :departure and routes.destination = :destination and trips.date = :date and trips.seats_left >= :passengers and trips.status_id in (1, 2)
                           order by routes.departure_time',
            ['departure' => $departure, 'destination' => $destination, 'date' => $date, 'passengers' => $passengers]);

        $terminals = Terminal::all('id', 'short_name');
        if (Auth::guard('cashier')->check())
        {
            return view('cashier.search-results')->with(compact('tickets', 'request', 'terminals'));
        }
        return view('passenger.search-results')->with(compact('tickets', 'request', 'terminals'));
    }
}

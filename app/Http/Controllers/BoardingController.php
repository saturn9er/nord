<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Trip;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BoardingController extends Controller
{
    public function show(Request $request)
    {
        $trip = Trip::select('id', 'status_id')->where('passcode', $request->passcode)->first();

        $tripID = $trip->id;
        $status = $trip->status_id;

        if($status == Status::SCHEDULED || $status == Status::DELAYED || $status == Status::BOARDING)
        {
            $trip = Trip::select('trips.id', 'routes.name as route_name', 'trips.date', 'departure.short_name as departure', 'destination.short_name as destination', 'routes.departure_time', 'routes.arrival_time', 'buses.plate_number', 'trips.passcode','trips.status_id', 'trips.status_time')
                ->join('statuses', 'statuses.id', '=', 'trips.status_id')
                ->join('routes', 'routes.id', '=', 'trips.route_id')
                ->leftJoin('buses', 'buses.id', '=', 'trips.bus_id')
                ->join('terminals as departure', 'departure.id', '=', 'routes.departure')
                ->join('terminals as destination', 'destination.id', '=', 'routes.destination')
                ->where('trips.id', $tripID)
                ->first();

            $notBoarded =   Ticket::where('tickets.trip_id', $tripID)
                            ->where('tickets.boarded_at', '=', null)
                            ->count();

            $trip->status_id = Status::BOARDING;
            $trip->save();

            return view('driver.boarding.show')->with(compact('trip', 'notBoarded'));
        }
        elseif ($status == Status::DEPARTED)
        {
            return redirect('driver/trip?passcode='.$request->passcode);
        }
        else
        {
            return abort(404);
        }
    }

    public function check(Request $request)
    {
        $request->validate([
            'passcode' => 'required|string|min:6|max:6',
            'ticket_no' => 'required|numeric'
        ]);

        $ticket =   Ticket::select('tickets.id', 'tickets.trip_id', 'tickets.boarded_at', 'trips.passcode')
                    ->join('trips', 'tickets.trip_id', '=', 'trips.id')
                    ->where('tickets.id', $request->ticket_no)
                    ->firstOrFail();

        if($ticket->passcode != $request->passcode)
        {
            Session::flash('ticket_no_error');
            return redirect('driver/boarding?passcode='.$request->passcode);
        }

        if($ticket->boarded_at == null)
        {
            $ticket->boarded_at = date("Y-m-d H:i:s");
            $ticket->save();

            Session::flash('success_boarded');
            return redirect('driver/boarding?passcode='.$request->passcode);
        }
        else
        {
            Session::flash('already_boarded');
            return redirect('driver/boarding?passcode='.$request->passcode);
        }

    }

    public function finish(Request $request)
    {
        $request->validate([
            'passcode' => 'required|string|min:6|max:6',
        ]);

        $trip = Trip::select('id', 'status_id')->where('passcode', $request->passcode)->first();
        $trip->status_id = Status::DEPARTED;
        $trip->status_time = date('H:i:s');
        $trip->actual_departure = date('H:i:s');
        $trip->save();

        return redirect('driver/trip?passcode='.$request->passcode);
    }

}

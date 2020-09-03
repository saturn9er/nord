<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Status;
use App\Trip;
use App\Ticket;
use Illuminate\Http\Request;
use App\Services\TripService as Service;
use Illuminate\Support\Facades\Session;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $trip = Trip::select('id', 'status_id')->where('passcode', $request->passcode)->first();

        $tripID = $trip->id;
        $status = $trip->status_id;

        if($status == Status::DEPARTED)
        {
            $trip = Trip::select('trips.id', 'routes.name as route_name', 'trips.actual_departure', 'departure.short_name as departure', 'destination.short_name as destination', 'routes.departure_time', 'routes.arrival_time', 'buses.plate_number', 'trips.passcode','trips.status_id', 'trips.status_time')
                ->join('statuses', 'statuses.id', '=', 'trips.status_id')
                ->join('routes', 'routes.id', '=', 'trips.route_id')
                ->leftJoin('buses', 'buses.id', '=', 'trips.bus_id')
                ->join('terminals as departure', 'departure.id', '=', 'routes.departure')
                ->join('terminals as destination', 'destination.id', '=', 'routes.destination')
                ->where('trips.id', $tripID)
                ->first();

            $boarded =   Ticket::where('tickets.trip_id', $tripID)
                ->where('tickets.boarded_at', '!=', null)
                ->count();

            return view('driver.trip.show')->with(compact('trip', 'boarded'));
        }
        elseif ($status == Status::SCHEDULED || $status == Status::DELAYED || $status == Status::BOARDING)
        {
            return redirect('driver/boarding?passcode='.$request->passcode);
        }
        else
        {
            return abort(404);
        }
    }

    public function finish(Request $request)
    {
        $request->validate([
            'passcode' => 'required|string|min:6|max:6',
        ]);

        $trip = Trip::select('id', 'status_id')->where('passcode', $request->passcode)->first();
        $trip->status_id = Status::ARRIVED;
        $trip->status_time = date('H:i:s');
        $trip->actual_arrival = date('H:i:s');
        $trip->save();

        Session::flash('arrived');
        return redirect('driver/home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trip = Service::getTripByID($id);
        $buses = Bus::select('id', 'plate_number', 'seats')->get();
        $statuses = Status::select('id', 'name')->get();
        return view('agent.trips.edit')->with(compact('trip', 'buses', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|numeric',
            'status_time' => 'nullable|string|max:5|min:4',
            'actual_departure' => 'nullable|string|max:8|min:7',
            'actual_arrival' => 'nullable|string|max:8|min:7',
            'bus_id' => 'nullable|numeric',
            'passcode' => 'required|string|min:6|max:6',
            'price' => 'required|numeric',
        ]);

        $status_time        = $request->status_time;
        $actual_departure   = $request->actual_departure;
        $actual_arrival     = $request->actual_arrival;
        $shortTimePattern = '/([01]?[0-9]|2[0-3]):[0-5][0-9]/u';
        $fullTimePattern = '/([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]/u';

        if((!is_null($status_time)) && (!preg_match($shortTimePattern, $status_time)))
        { Session::flash('status_time_error'); return back(); }
        if((!is_null($actual_departure)) && (!preg_match($fullTimePattern, $actual_departure)))
        { Session::flash('actual_departure_error'); return back(); }
        if((!is_null($actual_arrival)) && (!preg_match($fullTimePattern, $actual_arrival)))
        { Session::flash('actual_arrival_error'); return back(); }

        $trip = Trip::where('id', $id)->first();
        $trip->status_id        = $request->status;
        $trip->status_time      = !is_null($status_time) ? date_create($status_time)->format('H:i:s') : null;
        $trip->actual_departure = !is_null($actual_departure) ? date_create($actual_departure)->format('H:i:s') : null;
        $trip->actual_arrival   = !is_null($actual_arrival) ? date_create($actual_arrival)->format('H:i:s') : null;
        $trip->bus_id           = $request->bus;
        $trip->passcode         = $request->passcode;
        $trip->price            = $request->price;
        $trip->save();

        Session::flash('edit_success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

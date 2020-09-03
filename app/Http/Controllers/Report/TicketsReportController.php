<?php

namespace App\Http\Controllers\Report;

use App\Status;
use App\Http\Controllers\Controller;
use App\Trip;
use App\Ticket;
use Illuminate\Support\Facades\DB;


class TicketsReportController extends Controller
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

        $notSoldTickets     = Trip::select(DB::raw('sum(seats_left) as seats_left'))->where('status_id', '<>', Status::CANCELLED)->where('date', $date)->first();

        $soldTickets        = Ticket::where('returned', 0)->join('trips', 'trips.id', 'tickets.trip_id')->where('trips.date', $date)->count();

        $returnedTickets    = Ticket::where('returned', 1)->join('trips', 'trips.id', 'tickets.trip_id')->where('trips.date', $date)->count();

        $date = $date->format('d-m-Y');

        return view('agent.reports.tickets')->with(compact( 'notSoldTickets', 'soldTickets', 'returnedTickets', 'date'));

    }
}

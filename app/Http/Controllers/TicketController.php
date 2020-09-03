<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TicketService as Service;

class TicketController extends Controller
{
   public function show()
   {
       //if(isset $_COOKIE['j']);
       $passengerID = Auth::id();
       $tickets = Service::getTicketsByPassengerID($passengerID);
       return view('passenger.home')->with(compact('tickets'));
   }
}

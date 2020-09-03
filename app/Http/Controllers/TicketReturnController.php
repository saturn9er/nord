<?php

namespace App\Http\Controllers;

use App\Services\TicketReturnService as Service;

class TicketReturnController extends Controller
{
   public function __invoke($id)
   {
       Service::returnTicket($id);
       return back();
   }
}

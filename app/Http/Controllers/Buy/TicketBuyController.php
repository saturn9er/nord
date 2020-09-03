<?php

namespace App\Http\Controllers\Buy;

use App\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\DocumentType;
use App\Services\TicketBuyService as Service;

class TicketBuyController extends Controller
{
    public function show(Request $request)
    {
        $request->validate([
            'trip'          => 'required|numeric',
            'passengers'    => 'required|numeric'
        ]);

        $trip       = $request->trip;
        $passengers = $request->passengers;

        $document_types = DocumentType::get();

        $ticket = DB::select('select routes.name as route, routes.dep as departure, routes.dest as destination, routes.departure_time, routes.arrival_time, trips.id as trip_id, trips.date, trips.price, trips.seats_left 
                           from trips, ( select routes.id, routes.name, routes.departure_time, routes.arrival_time, routes.departure, routes.destination, departure.name as dep, destination.name as dest
                                         from routes 
                                         inner join terminals as departure on routes.departure = departure.id 
                                         inner join terminals as destination on routes.destination = destination.id 
                                         order by routes.departure, routes.destination) as routes 
                           where routes.id = trips.route_id and trips.id = :trip  and trips.seats_left >= :passengers and trips.status_id in (1, 2)
                           order by routes.departure_time',
            ['trip' => $trip, 'passengers' => $passengers]);

        Cookie::queue(Cookie::make('search_trip', $trip, time()+3600, '/'));
        Cookie::queue(Cookie::make('search_passengers', $passengers, time()+3600, '/'));

        if (Auth::guard('cashier')->check())
        {
            return view('cashier.sell')->with(compact('ticket', 'request', 'document_types'));
        }

        return view('passenger.buy')->with(compact('ticket', 'request', 'document_types'));
    }

    public function buy(Request $request)
    {
        $request->validate([
            'trip'              => 'required|numeric',
            'passengers'        => 'required|numeric'
        ]);

        $trip               = $request->trip;
        $passengers         = $request->passengers;
        $passengerID        = Auth::id();
        $promoCode          = $request->promocode;
        $promoCodeDiscount  = Service::getPromoCodeDiscount($promoCode, $passengerID);
        $ticketPrice        = Service::getTicketPriceByTripID($trip);

        Service::activatePromoCode($promoCode, $passengerID);

        for($i = 0; $i < $passengers; $i++)
        {
            $name           = $request->fullname[$i];
            $documentType   = $request->document_type[$i];
            $documentNumber = $request->document_number[$i];
            $personalityID  = Service::addNewPersonality($name, $documentType, $documentNumber, $passengerID);
            $price          = $ticketPrice;
            $qrCode         = str_random(32);

            if($price > $promoCodeDiscount)
            {
                $price -= $promoCodeDiscount;
                $promoCodeDiscount = 0;
            }
            else
            {
                $promoCodeDiscount -= $price;
                $price = 0;
            }

            $seatID = Service::bookASeat($trip);

            Service::createTicket($price, $trip, $personalityID, $passengerID, $seatID, $qrCode);
        }

        return redirect('/');
    }

    public function sell(Request $request)
    {
        $request->validate([
            'trip'              => 'required|numeric'
        ]);

        $trip               = $request->trip;
        $passengerID        = null;
        $ticketPrice        = Service::getTicketPriceByTripID($trip);

        $name           = $request->fullname;
        $documentType   = $request->document_type;
        $documentNumber = $request->document_number;
        $personalityID  = Service::addNewPersonality($name, $documentType, $documentNumber, $passengerID);
        $price          = $ticketPrice;
        $qrCode         = str_random(32);
        $seatID         = Service::bookASeat($trip);

        $ticketID = Service::createTicket($price, $trip, $personalityID, $passengerID, $seatID, $qrCode);

        return redirect('cashier/tickets/'.$ticketID.'/print');
    }
}

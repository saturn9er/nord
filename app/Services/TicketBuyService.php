<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Trip;
use App\Ticket;
use App\Seat;
use App\PromoCode;
use App\Personality;


class TicketBuyService
{
    public static function getTicketPriceByTripID($tripID)
    {
        $ticketPrice = Trip::select('price')->where('id', $tripID)->firstOrFail();
        $ticketPrice = intval($ticketPrice->price);

        return $ticketPrice;
    }

    public static function getPromoCodeDiscount($promoCode, $passengerID)
    {
        if(!empty($promoCode) && (strlen($promoCode) == 6))
        {
            if($promocode = PromoCode::select('discount')
                            ->where('promo_code', $promoCode)
                            ->where('issued_to', $passengerID)
                            ->where('used', 0)
                            ->first())
            {
                return $promocode->discount;
            }
        }
        return 0;
    }

    public static function addNewPersonality($name, $documentType, $documentNo, $passengerID)
    {
        $personality = new Personality();

        $personality->name              = $name;
        $personality->document_type_id  = $documentType;
        $personality->document_no       = $documentNo;
        $personality->passenger_id      = $passengerID;

        $personality->save();

        return $personality->id;
    }

    public static function bookASeat($tripID)
    {
        $seat = Seat::where('trip_id', $tripID)->where('vacant', 1)->first();
        $seatID = $seat->id;
        $seat->vacant = 0;
        $seat->save();

        $trip = Trip::where('id', $tripID)->first();
        $trip->seats_left--;
        $trip->save();

        return $seatID;
    }

    public static function createTicket($price, $trip, $personalityID, $passengerID, $seatID, $qrCode)
    {
        $ticket = new Ticket;

        $ticket->price          = $price;
        $ticket->trip_id        = $trip;
        $ticket->personality_id = $personalityID;
        $ticket->passenger_id   = $passengerID;
        $ticket->seat_id        = $seatID;
        $ticket->qr_code        = $qrCode;

        $ticket->save();

        return $ticket->id;
    }

    public static function activatePromoCode($promoCode, $passengerID)
    {
        if($promocode = PromoCode::where('promo_code', $promoCode)->where('issued_to', $passengerID)->first())
        {
            $promocode->used = 1;
            $promocode->save();
        }
    }
}
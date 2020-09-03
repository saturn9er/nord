<?php
/**
 * Created by IntelliJ IDEA.
 * User: marshall
 * Date: 14/03/2018
 * Time: 7:51 PM
 */

namespace App\Services;

use App\PromoCode;
use Illuminate\Support\Facades\Auth;
use App\Trip;
use App\Ticket;
use App\Seat;
use App\Status;


class TicketReturnService
{
    public static function returnTicket($id)
    {
        $passengerID = Auth::id();

        $ticket = Ticket::where('id', $id)->first();

        $trip = Trip::select('status_id')->where('id', $ticket->trip_id)->first();

        if($ticket->passenger_id == $passengerID)
        {
            if(!is_null($ticket->seat_id))
            {
                if (($trip->status_id == Status::SCHEDULED) || ($trip->status_id == Status::CANCELLED) || ($trip->status_id == Status::NO_INFO))
                {
                    $seatID = intval($ticket->seat_id);
                    $ticket->seat_id = null;
                    $ticket->save();

                    self::freeASeat($seatID, $ticket->trip_id);

                    if ($ticket->price > 0) {
                        $promoCodeID = self::createAPromoCode($ticket->price, $ticket->passenger_id);

                        $ticket->promo_code_id = $promoCodeID;
                        $ticket->save();
                    }

                    $ticket->returned = 1;
                    $ticket->save();
                }
            }
        }
    }

    //  Makes a seat from seats table vacant and increments number of vacant seats in trips table
    public static function freeASeat($seatID, $tripID)
    {
        $seat = Seat::where('id', $seatID)->first();
        $seat->vacant = 1;
        $seat->save();

        $trip = Trip::where('id', $tripID)->first();
        $trip->seats_left++;
        $trip->save();
    }

    // Creates a promo code with a discount of the ticket price, assigns it to the passenger
    public static function createAPromoCode($price, $passengerID)
    {
        $promoCode = new PromoCode();
        $promoCode->promo_code = str_random(6);
        $promoCode->discount = $price;
        $promoCode->issued_to = $passengerID;
        $promoCode->save();

        return $promoCode->id;
    }
}
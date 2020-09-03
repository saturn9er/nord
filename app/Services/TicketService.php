<?php
/**
 * Created by IntelliJ IDEA.
 * User: marshall
 * Date: 11/03/2018
 * Time: 9:16 PM
 */

namespace App\Services;
use App\Ticket;


class TicketService
{
    public static function getTicketsByPassengerID($passengerID)
    {
        return Ticket::select('tickets.id', 'tickets.price', 'tickets.trip_id as trip', 'routes.name as route', 'departure.name as origin', 'destination.name as destination', 'routes.departure_time', 'routes.arrival_time', 'trips.date', 'trips.departure_gate as gate', 'personalities.name as person_name', 'seats.name as seat', 'tickets.qr_code', 'tickets.returned', 'tickets.boarded_at', 'promo_codes.promo_code', 'trips.status_id')
                ->join('trips', 'trips.id', '=', 'tickets.trip_id')
                ->join('routes', 'routes.id', '=', 'trips.route_id')
                ->join('terminals as departure', 'departure.id', '=', 'routes.departure')
                ->join('terminals as destination', 'destination.id', '=', 'routes.destination')
                ->join('personalities', 'personalities.id', '=', 'tickets.personality_id')
                ->leftJoin('seats', 'seats.id', '=', 'tickets.seat_id')
                ->leftJoin('promo_codes', 'promo_codes.id', '=', 'tickets.promo_code_id')
                ->where('tickets.passenger_id', $passengerID)
                ->orderBy('tickets.id', 'desc')
                ->paginate(10);
    }

    public static function getTicketByTicketID($id)
    {
        return Ticket::select('tickets.id', 'tickets.price', 'tickets.trip_id as trip', 'routes.name as route', 'departure.name as origin', 'departure.location as location', 'destination.name as destination', 'routes.departure_time', 'routes.arrival_time', 'trips.date', 'trips.departure_gate as gate', 'personalities.name as person_name', 'personalities.document_no', 'document_types.name as document_type', 'seats.name as seat', 'tickets.qr_code', 'tickets.returned')
            ->join('trips', 'trips.id', '=', 'tickets.trip_id')
            ->join('routes', 'routes.id', '=', 'trips.route_id')
            ->join('terminals as departure', 'departure.id', '=', 'routes.departure')
            ->join('terminals as destination', 'destination.id', '=', 'routes.destination')
            ->join('personalities', 'personalities.id', '=', 'tickets.personality_id')
            ->join('seats', 'seats.id', '=', 'tickets.seat_id')
            ->join('document_types', 'document_types.id', '=', 'personalities.document_type_id')
            ->where('tickets.id', $id)
            ->first();
    }
}
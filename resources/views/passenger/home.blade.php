@extends('passenger.layouts.app')
@section('content')
<style>
    .ticket-field-label {!important font-size: 12px;}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="font-weight-bold">@lang('ticket.my_tickets')</h2>
            @unless (count($tickets))
            <h1 class="text-center font-weight-bold" style="margin-top: 30px;">@lang('search.nothing')</h1>
            @endunless
            @foreach ($tickets as $ticket)
            <div class="card" style="margin-top: 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4 class="font-weight-bold">
                                @lang('ticket.ticket_no'){{ $ticket->id }}
                                @if($ticket->returned == 1)
                                <span class="badge badge-pill badge-danger">@lang('ticket.returned')</span>
                                @endif
                            </h4>
                        </div>
                    </div>
                    <table cellpadding="5" style="font-size: 15px;">
                        <tr>
                            <td>
                                <label for="origin" style="font-size: 11px;">@lang('ticket.departure')</label>
                                <p class="font-weight-bold" id="origin">{{ $ticket->origin }}</p>
                            </td>
                            <td></td>
                            <td>
                                <label for="date" style="font-size: 11px;">@lang('ticket.date_and_departure_time')</label>
                                <p class="font-weight-bold" id="date">@date($ticket->date) @lang('ticket.at') @time($ticket->departure_time)</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="destination" style="font-size: 11px;">@lang('ticket.arrival')</label>
                                <p class="font-weight-bold" id="destination">{{ $ticket->destination }}</p>
                            </td>
                            <td></td>
                            <td>
                                <label for="date" style="font-size: 11px;">@lang('ticket.arrival_time')</label>
                                <p class="font-weight-bold" id="date">@time($ticket->arrival_time)</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="name" style="font-size: 11px;">@lang('ticket.passenger_name')</label>
                                <p class="font-weight-bold" id="name">{{ $ticket->person_name }}</p>
                            </td>
                            <td></td>
                            <td>
                                <label for="gate" style="font-size: 11px;">@lang('ticket.seat_no')</label>
                                <p class="font-weight-bold" id="gate">{{ $ticket->seat }}</p>
                            </td>
                        </tr>
                    </table>
                    <hr>
                    <div class="row" style="margin-bottom: -10px;">
                        <div class="col">
                            <div class="btn-group align-middle" style="margin-top: 12px;" role="group">
                                @if($ticket->returned == 0)
                                <a class="btn btn-danger" href="{{ url('/passenger/tickets').'/'.$ticket->id.'/print' }}" role="button">@lang('ticket.print')</a>
                                @if((($ticket->status_id == App\Status::SCHEDULED) || ($ticket->status_id == App\Status::CANCELLED) || ($ticket->status_id == App\Status::NO_INFO)) && (is_null($ticket->boarded_at)))
                                <a class="btn btn-light" href="{{ url('/passenger/tickets').'/'.$ticket->id.'/return' }}" onclick="return confirm('@lang('ticket.return_alert')')" role="button">@lang('ticket.return')</a>
                                @endif
                                @endif
                            </div>
                        </div>
                        <div class="col text-right">
                            <label for="gate" class="font-weight-bold" style="font-size: 11px;">@lang('ticket.paid')</label>
                            <h3 id="paid" class="font-weight-bold">{{ $ticket->price }}₽</h3>
                            @if($ticket->returned == 1 && $ticket->price > 0)
                            <span class="font-weight-bold">@lang('ticket.promocode'):</span> <span class="badge badge-secondary">{{ $ticket->promo_code }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-xl-8 col-12">
            {{  $tickets->links() }}
        </div>
    </div>
</div>
@endsection

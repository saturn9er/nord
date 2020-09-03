<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/png" href="{{ asset('public/favicon.ico') }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('ticket.ticket_printing') #{{ $ticket->id }}</title>

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body onload="window.print()">
<div id="app">
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-3">
                    <h1 class="font-weight-bold text-danger">@lang('app.name')</h1>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $ticket->qr_code }}">
                    <p><h4>@lang('ticket.ticket_no'){{ $ticket->id }}</h4></p>
                    <p><h6>@lang('ticket.express_boarding')</h6></p>
                </div>
                <div class="col-9">
                    <h6><b>@lang('ticket.trip_info')</b></h6>
                    <span class="font-weight-bold text-danger" style="font-size: 12px;">@lang('ticket.date')</span>
                    <h5>@date($ticket->date)</h5>
                    <span class="font-weight-bold text-danger" style="font-size: 12px;">@lang('ticket.departure') @time($ticket->departure_time)</span>
                    <h5>{{ $ticket->origin }}</h5>
                    <span class="font-weight-bold text-danger" style="font-size: 12px;">@lang('ticket.arrival') @time($ticket->arrival_time)</span>
                    <h5>{{ $ticket->destination }}</h5>
                    <hr>
                    <span class="font-weight-bold text-danger" style="font-size: 12px;">@lang('ticket.passenger_name')</span>
                    <h5>{{ $ticket->person_name }}</h5>
                    <span class="font-weight-bold text-danger" style="font-size: 12px;">@lang('ticket.document')</span>
                    <h5>{{ $ticket->document_type }} {{ $ticket->document_no }}</h5>
                    <div class="alert alert-warning" role="alert">
                        @lang('ticket.boarding_alert')
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col">
                    <div class="card">
                        <div class="card-header font-weight-bold">@lang('ticket.departure_point'): {{ $ticket->origin }}</div>
                        <div class="card-body">
                            <div id="map" style="width:100%; height:400px"></div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col col-md-6">
                    <div class="alert alert-success" role="alert">
                        @lang('ticket.departure_alert')
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="alert alert-info" role="alert">
                        @lang('ticket.baggage_alert')
                    </div>
                </div>
                <h1 class="font-weight-light text-danger">@lang('ticket.wish')</h1>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card" style="margin-top: 0px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <h1 class="font-weight-bold text-danger">@lang('app.name')</h1>
                                    <h4 class="font-weight-bold">BOARDING PASS</h4>
                                    <h6>@lang('ticket.boarding_pass')</h6>
                                </div>
                                <div class="col-2">
                                    <img align="right" src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $ticket->qr_code }}">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('public/js/app.js') }}"></script>
<script>
    function initMap() {
        var terminal = {lat: {{ $location[0] }}, lng: {{ $location[1] }}};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: terminal
        });
        var marker = new google.maps.Marker({
            position: terminal,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.maps_api_key') }}&callback=initMap">
</script>
</body>
</html>

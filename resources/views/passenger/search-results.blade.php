@extends('passenger.layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            <h2 class="font-weight-bold">@lang('search.ticket_search')</h2>
            <div class="card">
                <div class="card-body">
                    @guest
                    <form method="get" action="{{ url('/tickets/search') }}">
                    @endguest
                    @auth('passenger')
                    <form method="get" action="{{ url('passenger/tickets/search') }}">
                    @endauth
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col">
                                <label class="font-weight-bold" for="origin">@lang('search.from')</label>
                                <select name="departure" id="origin" class="form-control" required>
                                    <option disabled>@lang('search.choose_origin')</option>
                                    @foreach ($terminals as $terminal)
                                    <option value="{{ $terminal->id }}" @if($terminal->id == $request->departure)) selected @endif>{{ $terminal->short_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="destination-box" class="col">
                                <label class="font-weight-bold" for="destination">@lang('search.to')</label>
                                <select name="destination" id="destination" class="form-control" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col-6" id="datepicker-container">
                                <label class="font-weight-bold" for="datepicker">@lang('search.when')</label>
                                <div class="input-group date" id="datepicker">
                                    <input name="date" type="text" class="form-control" id="datepicker-input" value="{{ $request->input('date') }}" style="border-radius: .25rem;" required>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6" id="datepicker-container">
                                <label class="font-weight-bold" for="passengers-count">@lang('search.passengers')</label>
                                <select name="passengers" id="passengers-count" class="form-control" required>
                                    @for ($i = 1; $i < 10; $i++)
                                    <option value="{{ $i }}" @if($i == $request->passengers) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input class="btn btn-danger btn-lg btn-block font-weight-bold" type="submit" value="@lang('search.find_ticket')">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            @empty($tickets)
                <h1 class="text-center font-weight-bold" style="margin-top: 30px;">@lang('search.nothing')</h1>
            @endempty

            @foreach($tickets as $ticket)
            <div class="card" style="margin-top: 10px;">
                <div class="card-body">
                    <div class="form-row" style="margin-bottom: 10px;">
                        <span class="badge badge-danger">{{ $ticket->route }}</span>
                        @if($ticket->seats_left < 5)
                        <span class="badge badge-warning">@lang('search.few_tickets')</span>
                        @endif
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <h4 class="font-weight-bold"> {{ date_create($ticket->departure_time)->format('H:i') }}</h4>
                            <h6>{{ $ticket->departure }}</h6>
                        </div>
                        <div class="col-6 text-right">
                            <h4 class="font-weight-bold"> {{ date_create($ticket->arrival_time)->format('H:i') }}</h4>
                            <h6>{{ $ticket->destination }}</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row" style="margin-bottom: 5px;">
                        <div class="col-12 text-right">
                            @guest
                            <a href="{{ url('tickets/buy').'?trip='.$ticket->trip_id.'&passengers='.$request->passengers }}" class="btn btn-outline-danger font-weight-bold" role="button" aria-pressed="true">@lang('search.buy') {{ intval($ticket->price)*intval($request->passengers) }}₽*</a>
                            @endguest
                            @auth('passenger')
                            <a href="{{ url('passenger/tickets/buy').'?trip='.$ticket->trip_id.'&passengers='.$request->passengers }}" class="btn btn-outline-danger font-weight-bold" role="button" aria-pressed="true">@lang('search.buy') {{ intval($ticket->price)*intval($request->passengers) }}₽*</a>
                            @endauth
                        </div>
                    </div>
                    <div class="form-row" style="margin-bottom: -10px;">
                        <div class="col-12 text-right">
                            <small>@lang('search.baggage')</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.ru.min.js"></script>
<!--suppress JSAnnotator -->
<script>
    jQuery(document).ready(function($){
        $('#datepicker').datepicker({
            format: "dd-mm-yyyy",
            startDate: '0',
            endDate: '+3m',
            language: "ru",
            maxViewMode: 0
        });

        $("#origin").ready(function(){
            $.get("{{ url('api/terminals/').'/'}}"+$("#origin").val()+"/destinations",
                function(data) {
                    var destination = $('#destination');
                    destination.empty();
                    $.each(data, function(index, element) {
                        if ({{ $request->destination }} == element.id) {
                            destination.append("<option value='"+ element.id +"' selected > " + element.short_name + " </option>");
                        } else {
                            destination.append("<option value='"+ element.id +"' > " + element.short_name + " </option>");
                        }
                    });
                });
        });

        $('#origin').change(function(){
            $.get("{{ url('api/terminals/').'/'}}"+$(this).val()+"/destinations",
                function(data) {
                    var destination = $('#destination');
                    destination.empty();

                    $.each(data, function(index, element) {
                        destination.append("<option value='"+ element.id +"'>" + element.short_name + "</option>");
                    });
                });
        });
    });
</script>
@endsection


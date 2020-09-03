@extends('agent.layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            <h2 class="font-weight-bold">@lang('trip.active_trips')</h2>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label for="terminal">@lang('schedule.terminal')</label>
                            <select name="terminal" id="terminal" class="form-control"></select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 10px;">
        <div class="col-xl-8 col-12">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-departure-tab" data-toggle="pill" href="#pills-departure" role="tab" aria-controls="pills-departure" aria-selected="false">@lang('schedule.departure')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-arrival-tab" data-toggle="pill" href="#pills-arrival" role="tab" aria-controls="pills-arrival" aria-selected="true">@lang('schedule.arrival')</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 10px;">
        <div class="col-12">
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade" id="pills-arrival" role="tabpanel" aria-labelledby="pills-arrival-tab">
                    <table class="table table-sm table-hover">
                        <thead>
                        <tr>
                            <th scope="col">@lang('schedule.time')</th>
                            <th scope="col">@lang('schedule.from')</th>
                            <th scope="col">@lang('schedule.date')</th>
                            <th scope="col">@lang('trip.actual_departure')</th>
                            <th scope="col">@lang('schedule.status')</th>
                            <th scope="col">@lang('bus.bus')</th>
                            <th scope="col">@lang('trip.seats_left')</th>
                            <th scope="col">@lang('app.options')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($arrivals as $arrival)
                        <tr>
                            <td>@time($arrival->arrival_time)</td>
                            <td><span class="badge badge-danger" style="width: 35px;">{{ $arrival->route_name }}</span> {{ $arrival->departure}}</td>
                            <td>@short_date($arrival->date)</td>
                            <td>{{ $arrival->actual_departure }}</td>
                            <td>@choice('schedule.statuses', $arrival->status_id, ['time' => date_create($arrival->status_time)->format('H:i')])</td>
                            <td>{{ $arrival->plate_number }}</td>
                            <td>{{ $arrival->seats_left }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-success btn-sm" title="@lang('bus.location')" href="https://google.com/maps/place/{{ $arrival->latitude }},{{ $arrival->longitude }}" role="button"><i class="fas fa-location-arrow"></i></a>
                                    <a class="btn btn-primary btn-sm" title="@lang('app.edit')" href="{{ url('agent/trips/'.$arrival->trip_id.'/edit') }}" role="button"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" title="@lang('trip.print')" href="{{ url('agent/trips/'.$arrival->trip_id.'/print') }}" role="button"><i class="fas fa-print"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade show active" id="pills-departure" role="tabpanel" aria-labelledby="pills-departure-tab">
                    <table class="table table-sm table-hover">
                        <thead>
                        <tr>
                            <th scope="col">@lang('schedule.time')</th>
                            <th scope="col">@lang('schedule.to')</th>
                            <th scope="col">@lang('schedule.date')</th>
                            <th scope="col">@lang('trip.actual_departure')</th>
                            <th scope="col">@lang('schedule.status')</th>
                            <th scope="col">@lang('bus.bus')</th>
                            <th scope="col">@lang('trip.seats_left')</th>
                            <th scope="col">@lang('app.options')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($departures as $departure)
                        <tr>
                            <td>@time($departure->departure_time)</td>
                            <td><span class="badge badge-danger" style="width: 35px;">{{ $departure->route_name }}</span> {{ $departure->destination }}</td>
                            <td>@short_date($departure->date)</td>
                            <td>{{ $departure->actual_departure }}</td>
                            <td>@choice('schedule.statuses', $departure->status_id, ['time' => date_create($departure->status_time)->format('H:i')])</td>
                            <td>{{ $departure->plate_number }}</td>
                            <td>{{ $departure->seats_left }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-success btn-sm" title="@lang('bus.location')" href="https://google.com/maps/place/{{ $departure->latitude }},{{ $departure->longitude }}" role="button"><i class="fas fa-location-arrow"></i></a>
                                    <a class="btn btn-primary btn-sm" title="@lang('app.edit')" href="{{ url('agent/trips/'.$departure->trip_id.'/edit') }}" role="button"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" title="@lang('trip.print')" href="{{ url('agent/trips/'.$departure->trip_id.'/print') }}" role="button"><i class="fas fa-print"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--suppress JSAnnotator -->
<script>
    $(Document).ready(function(){
        $.get("{{ url('api/terminals') }}",
            function(data) {
                var destination = $('#terminal');
                destination.empty();
                $.each(data, function(index, element) {
                    if ({{ $terminalID }} == element.id) {
                        destination.append("<option value='"+ element.id +"' selected > " + element.short_name + " </option>");
                    } else {
                        destination.append("<option value='"+ element.id +"' > " + element.short_name + " </option>");
                    }
                });
            });

        $('#terminal').change(function(){
            var terminal = $('#terminal').val();
            window.location.href = '{{ url('agent/trips/active').'/' }}'+terminal;
        });
    });
</script>
@endsection


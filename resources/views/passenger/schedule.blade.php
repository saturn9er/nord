@extends('passenger.layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            <h2 class="font-weight-bold">@lang('schedule.schedule')</h2>
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
                    <a class="nav-link active" id="pills-arrival-tab" data-toggle="pill" href="#pills-arrival" role="tab" aria-controls="pills-arrival" aria-selected="true">@lang('schedule.arrival')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-departure-tab" data-toggle="pill" href="#pills-departure" role="tab" aria-controls="pills-departure" aria-selected="false">@lang('schedule.departure')</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row justify-content-center" style="margin-top: 10px;">
        <div class="col-xl-8 col-12">
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-arrival" role="tabpanel" aria-labelledby="pills-arrival-tab">
                    <table class="table table-sm table-hover">
                        <thead>
                        <tr>
                            <th scope="col">@lang('schedule.time')</th>
                            <th scope="col">@lang('schedule.from')</th>
                            <th scope="col">@lang('schedule.date')</th>
                            <th scope="col">@lang('schedule.status')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($arrivals as $arrival)
                        <tr>
                            <td>@time($arrival->arrival_time)</td>
                            <td><span class="badge badge-danger" style="width: 35px;">{{ $arrival->route_name }}</span> {{ $arrival->departure}}</td>
                            <td>@short_date($arrival->date)</td>
                            <td>@choice('schedule.statuses', $arrival->status_id, ['time' => date_create($arrival->status_time)->format('H:i')])</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="pills-departure" role="tabpanel" aria-labelledby="pills-departure-tab">
                    <table class="table table-sm table-hover">
                        <thead>
                        <tr>
                            <th scope="col">@lang('schedule.time')</th>
                            <th scope="col">@lang('schedule.to')</th>
                            <th scope="col">@lang('schedule.date')</th>
                            <th scope="col">@lang('schedule.status')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($departures as $departure)
                        <tr>
                            <td>@time($departure->departure_time)</td>
                            <td><span class="badge badge-danger" style="width: 35px;">{{ $departure->route_name }}</span> {{ $departure->destination}}</td>
                            <td>@short_date($departure->date)</td>
                            <td>@choice('schedule.statuses', $departure->status_id, ['time' => date_create($departure->status_time)->format('H:i')])</td>
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
            @guest
            window.location.href = '{{ url('schedule').'/' }}'+terminal;
            @endguest
            @auth('passenger')
            window.location.href = '{{ url('passenger/schedule').'/' }}'+terminal;
            @endauth
        });
    });
</script>
@endsection


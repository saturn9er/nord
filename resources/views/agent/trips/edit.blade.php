@extends('agent.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="font-weight-bold">@lang('app.edit') #{{ $trip->id }}</h2>
            @if(Session::has('status_time_error'))
            <div class="alert alert-danger" role="alert">
                @lang('trip.status_time_error')
            </div>
            @endif
            @if(Session::has('actual_departure_error'))
            <div class="alert alert-danger" role="alert">
                @lang('trip.actual_departure_error')
            </div>
            @endif
            @if(Session::has('actual_arrival_error'))
            <div class="alert alert-danger" role="alert">
                @lang('trip.actual_arrival_error')
            </div>
            @endif
            @if(Session::has('edit_success'))
            <div class="alert alert-success" role="alert">
                @lang('trip.edit_success')
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ url('agent/trips/'.$trip->id) }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                            <label for="route" class="font-weight-bold col-sm-2 col-form-label">@lang('route.route')</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="route" value="{{ $trip->route_name }} {{ $trip->departure }} (@time($trip->departure_time)) - {{ $trip->destination }} (@time($trip->arrival_time))">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="route" class="font-weight-bold col-sm-2 col-form-label">@lang('trip.date')</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="route" value="@date($trip->date)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label for="status">@lang('trip.status')</label>
                                <select name="status" id="status" class="form-control" required>
                                    @foreach($statuses as $status)
                                    <option @if($status->id == $trip->status_id) selected @endif value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="status_time">@lang('trip.status_time')</label>
                                <input name="status_time" type="text" class="form-control" id="status_time" placeholder="04:34" value="@time($trip->status_time)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label for="actual_departure">@lang('trip.actual_departure')</label>
                                <input name="actual_departure" type="text" class="form-control" id="actual_departure" value="{{ $trip->actual_departure }}">
                            </div>
                            <div class="col-6">
                                <label for="actual_arrival">@lang('trip.actual_arrival')</label>
                                <input name="actual_arrival" type="text" class="form-control" id="actual_arrival" value="{{ $trip->actual_arrival }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label for="bus">@lang('bus.bus')</label>
                                <select name="bus" id="bus" class="form-control">
                                    @if(is_null($trip->bus_id))
                                    <option selected disabled>@lang('bus.choose_bus')</option>
                                    @foreach($buses as $bus)
                                    <option value="{{ $bus->id }}">{{ $bus->plate_number }} - {{ $bus->seats }} @lang('bus.seats')</option>
                                    @endforeach
                                    @else
                                    @foreach($buses as $bus)
                                    @if($bus->seats == $trip->seats)
                                    <option @if($trip->bus_id == $bus->id) selected @endif value="{{ $bus->id }}">{{ $bus->plate_number }} - {{ $bus->seats }} @lang('bus.seats')</option>
                                    @endif
                                    @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="col-6">
                                <label for="passcode">@lang('trip.passcode')</label>
                                <input name="passcode" type="text" class="form-control" id="passcode" value="{{ $trip->passcode }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label for="price">@lang('trip.price')</label>
                                <input name="price" type="text" class="form-control" id="price" value="{{ $trip->price }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button class="btn btn-success" type="submit">@lang('app.save')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

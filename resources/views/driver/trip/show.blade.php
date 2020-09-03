@extends('driver.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="alert alert-success" id="message">
                Удачного пути! Будте внимательней на дорогах!
            </div>
            <div class="card text-white bg-danger">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5>Контроль рейса #{{ $trip->id }}</h5>
                        </div>
                        <div class="col-6 text-right">
                            <form method="GET" action="{{ url('driver/trip/finish') }}">
                                <input type="hidden" name="passcode" value="{{ $trip->passcode }}">
                                <button type="submit" onclick="return confirm('Вы уверены что хотите отметить прибытие?');" class="btn btn-sm btn-outline-light">Отметить прибытие</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ url('driver/trip/check') }}">
                        <input type="hidden" name="passcode" value="{{ $trip->passcode }}">
                        <h6 class="font-weight-bold">Маршрут: {{ $trip->route_name }} {{ $trip->departure }}(@time($trip->departure_time)) - {{ $trip->destination }}(@time($trip->arrival_time))</h6>
                        <h6 class="font-weight-bold">Факт. отправление: @time($trip->actual_departure)</h6>
                        <h6 class="font-weight-bold">Автобус: {{ $trip->plate_number }}</h6>
                        <h6 class="font-weight-bold">Пассажиров: {{ $boarded }}</h6>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

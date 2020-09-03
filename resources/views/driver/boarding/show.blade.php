@extends('driver.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card text-white bg-danger">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5>Контроль рейса #{{ $trip->id }}</h5>
                        </div>
                        <div class="col-6 text-right">
                            <form method="GET" action="{{ url('driver/boarding/finish') }}">
                                <input type="hidden" name="passcode" value="{{ $trip->passcode }}">
                                <button type="submit" onclick="return confirm('Вы уверены что хотите закончить посадку?');" class="btn btn-sm btn-outline-light">Закончить посадку</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ url('driver/boarding/check') }}">
                        <input type="hidden" name="passcode" value="{{ $trip->passcode }}">
                        <h6 class="font-weight-bold">Маршрут: {{ $trip->route_name }} {{ $trip->departure }}(@time($trip->departure_time)) - {{ $trip->destination }}(@time($trip->arrival_time))</h6>
                        <h6 class="font-weight-bold">Дата: @date($trip->date)</h6>
                        <h6 class="font-weight-bold">Автобус: {{ $trip->plate_number }}</h6>
                        <h6 class="font-weight-bold">Ожидаются для посадки: {{ $notBoarded }} чел.</h6>
                        <hr>
                        @if(Session::has('success_boarded'))
                        <div style="width: 100%; height: 100%; margin: 0em; left: 0em; top: 0em; background: green; position: fixed; color: white; z-index: 100000;" class="text-center" id="message">
                            <br>
                            <i class="fas fa-check" style="font-size: 54px;"></i>
                            <h1>Успешно!</h1>
                            <h3>Пассажир посажен</h3>
                        </div>
                        @endif
                        @if(Session::has('already_boarded'))
                        <div style="width: 100%; height: 100%; margin: 0em; left: 0em; top: 0em; background: red; position: fixed; color: white; z-index: 100000;" class="text-center" id="message">
                            <br>
                            <h1>Пассажир по данному билету уже посажен!</h1>
                        </div>
                        @endif
                        @if(Session::has('ticket_no_error'))
                        <div style="width: 100%; height: 100%; margin: 0em; left: 0em; top: 0em; background: red; position: fixed; color: white; z-index: 100000;" class="text-center" id="message">
                            <br>
                            <h1>Неверный номер билета!</h1>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger" id="message">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-row justify-content-center">
                            <div class="col-4">
                                <label for="ticket_no">Номер билета</label>
                            </div>
                            <div class="col-6">
                                <input type="text" name="ticket_no" class="form-control" id="ticket_no">
                            </div>
                        </div>
                        <br>
                        <div class="form-row justify-content-center">
                            <div class="col-4">
                                <button type="submit" class="btn btn-lg btn-warning">Проверить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(Document).ready(function(){
        $('#message').delay(3000).hide(0);
    })
</script>
@endsection

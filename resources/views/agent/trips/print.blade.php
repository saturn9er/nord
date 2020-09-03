<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/png" href="{{ asset('public/favicon.ico') }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('trip.routing_list') #{{ $trip->id }}</title>

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body onload="window.print()">
<div id="app">
    <main class="py-4">
        <div class="container">
            <h3 class="text-danger font-weight-bold">{{ config('app.name') }}</h3>
            <div class="row justify-content-center">
                <div class="col text-center">
                    <h2>@lang('trip.routing_list') #<u>{{ $trip->id }}</u></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <h5>@lang('trip.date'): <u>@date($trip->date)</u></h5>
                    <h5>@lang('trip.bus_no'): <u>{{ $trip->plate_number }}</u> @empty ($trip->plate_number) ____________________________ @endempty</h5>
                    </h5>
                    <h5>@lang('trip.driver'): _______________________________________</h5>
                    <h5>Таб. номер: _________________</h5>
                    <h5>@lang('route.route'): <u>{{ $trip->route_name }} {{ $trip->departure }} - {{ $trip->destination }}</u></h5>

                    <small class="text-center">@lang('trip.timestamps')</small>
                    <table class="table table-sm table-bordered text-center">
                        <thead>
                        <tr>
                            <th></th>
                            <th>@lang('trip.scheduled')</th>
                            <th>@lang('trip.actual')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>@lang('trip.departure')</th>
                            <td>@time($trip->departure_time)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>@lang('trip.arrival')</th>
                            <td>@time($trip->arrival_time)</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-6">
                    <small>Показания одометра</small>
                    <table class="table table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th colspan="2"></th>
                                <th style="width: 150px;">Подпись</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th style="width: 200px;">При выезде</th>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>При возвращении</th>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <small>Отметка о состоянии здоровья водителя</small>
                    <table class="table table-sm table-bordered text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="width: 350px;">Состояние</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>При выезде</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>При возвращении</th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col">
                    <br>
                    <h4 class="text-center">@lang('trip.outages')</h4>
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th style="width: 250px;">Место (на станции, на линии)</th>
                            <th style="width: 100px;">С</th>
                            <th style="width: 100px;">До</th>
                            <th>Причина</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5>Отметка линейнего контроя: _____________________________________________________________________</h5>
                    <h5>Обслуживание в пути: ___________________________________________________________________________</h5>
                    <hr>
                    <h5>Автобус технически исправен. Выезд разрешен.
                        <br><br><b><em>Механик:</em></b> _______________________________________________________________
                    </h5>
                    <br>
                    <h5>Автобус, контрольное устройство, переговорное устройство в исправном состоянии. Указатели установлены.
                        <br><br><b><em>Водитель:</em></b> ______________________________________________________________
                    </h5>
                    <hr>
                    <h5>Отметка о приеме автобуса при возвращении
                        ________________________________________________________________________________________________
                        ________________________________________________________________________________________________
                        ________________________________________________________________________________________________
                        <br><br><b>Сдал <em>водитель:</em></b> ___________________________________
                        <b>Принял <em>механик:</em></b> ___________________________________
                    </h5>
                    <h5 class="text-right" style="margin-top: 100px">
                        <b><em>Диспетчер:</em></b> _________________________________________
                    </h5>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('public/js/app.js') }}"></script>
</body>
</html>

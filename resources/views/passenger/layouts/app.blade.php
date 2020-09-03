<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('public/favicon.ico') }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/nord.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand text-danger font-weight-bold" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li><a class="nav-link" href="{{ url('/') }}">@lang('search.ticket_search')</a></li>
                    <li><a class="nav-link" href="{{ url('/schedule') }}">@lang('schedule.schedule')</a></li>
                    <li><a class="nav-link" href="{{ route('login') }}">@lang('auth.login')</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">@lang('auth.register')</a></li>
                    @else
                    <li><a class="nav-link" href="{{ url('passenger') }}">@lang('passenger.my_tickets')</a></li>
                    <li><a class="nav-link" href="{{ url('passenger/tickets') }}">@lang('search.ticket_search')</a></li>
                    <li><a class="nav-link" href="{{ url('passenger/schedule') }}">@lang('schedule.schedule')</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('passenger/edit') }}">
                                @lang('passenger.edit')
                            </a>
                            <a class="dropdown-item" href="{{ url('passenger/help') }}">
                                @lang('help.help')
                            </a>
                            <a class="dropdown-item" href="{{ url('passenger/logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                @lang('auth.logout')
                            </a>

                            <form id="logout-form" action="{{ url('passenger/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 container-fluid flex-gr" style="min-height: 70vh">
        @yield('content')
    </main>

    <footer style="margin:10px">
        <div class="container">
            <div class="row">
                <h5 class="font-weight-bold">nordexpress</h5>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <b>Контактная информация</b>
                    <br>
                    АО "Норд-экспресс"
                    <br>
                    ИНН 230100732259
                    <br>
                    КПП 230101923
                    <br>
                    ОГРН 1172346358608
                    <br>
                    г. Краснодар, ул. Северная 405, 350002
                    <br>
                    +7(918)000-66-73
                </div>
                <div class="col-md-4">
                    <b>Разделы</b>
                    @guest
                    <br><a href="{{ url('/') }}">@lang('search.ticket_search')</a>
                    <br><a href="{{ url('/schedule') }}">@lang('schedule.schedule')</a>
                    <br><a href="{{ url('/help') }}">@lang('help.help')</a>
                    <br><a href="{{ route('login') }}">@lang('auth.login')</a>
                    <br><a href="{{ route('register') }}">@lang('auth.register')</a>
                    @else
                    <br><a href="{{ url('passenger') }}">@lang('passenger.my_tickets')</a>
                    <br><a href="{{ url('passenger/tickets') }}">@lang('search.ticket_search')</a>
                    <br><a href="{{ url('passenger/schedule') }}">@lang('schedule.schedule')</a>
                    <br><a href="{{ url('passenger/help') }}">@lang('help.help')</a>
                    @endguest
                </div>
                <div class="col-md-4">
                    <b>@lang('app.we_accept')</b>
                    <br>
                    <img src="http://wendysmithflatfee.com/wp-content/uploads/2016/04/Paypal_payment_icon1.png" height="80px;">
                </div>
            </div>
            <div class="col text-right small align-self-end">©2018 АО "Норд-эксперсс"</div>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="{{ asset('public/js/app.js') }}"></script>
</body>
</html>

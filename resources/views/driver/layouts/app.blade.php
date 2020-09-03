<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
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
                    <li><a class="nav-link" href="{{ route('driver.login') }}">Login</a></li>
                    <li><a class="nav-link" href="{{ route('driver.register') }}">Register</a></li>
                    @else
                    <li><a class="nav-link" href="{{ url('driver/home') }}">Контроль билетов</a></li>
                    <li><a class="nav-link" href="{{ url('driver/schedule') }}">Онлайн табло</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('driver.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('driver.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <div class="alert alert-secondary">
        <b>Дипетчерские:</b>
        <br>
        <em>Краснодар</em> +7(918)234-13-00
        <br>
        <em>Ростов-на-Дону</em> +7(900)725-91-00
        <br>
        <em>Мин. воды</em> +7(912)174-24-22
        <br>
        <b>Механики:</b>
        <br>
        <em>Краснодар</em> +7(918)644-43-20
        <br>
        <em>Ростов-на-Дону</em> +7(905)102-10-20
        <br>
        <em>Мин. воды</em> +7(937)632-23-61
        <br>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('public/js/app.js') }}"></script>
</body>
</html>

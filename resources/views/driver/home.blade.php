@extends('driver.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            @if (Session::has('arrived'))
            <div class="alert alert-success" id="message">
                Рейс успешно завершен!
            </div>
            @endif
            <div class="card text-white bg-danger">
                <div class="card-header">Вход в контроль рейса</div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger" id="message">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="GET" action="{{ url('driver/boarding') }}">
                        @csrf
                        <div class="form-row justify-content-center">
                            <div class="col-6">
                                <input type="text" name="passcode" class="form-control" id="passcode" placeholder="Код рейса">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-outline-light">Войти</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

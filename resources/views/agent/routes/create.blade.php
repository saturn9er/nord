@extends('agent.layouts.app')
@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            <h2 class="font-weight-bold">@lang('route.new')</h2>
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                @lang('route.create_success')
            </div>
            @endif
            @if(Session::has('terminals_match'))
            <div class="alert alert-danger" role="alert">
                @lang('route.terminals_match')
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
                    <form method="post" action="{{ url('/agent/routes') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="departure">@lang('route.departure')</label>
                                    <select name="departure" id="departure" class="form-control" required>
                                        <option selected disabled>@lang('terminal.choose')</option>
                                        @foreach($terminals as $terminal)
                                        <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6">
                                    <label for="destination">@lang('route.destination')</label>
                                    <select name="destination" id="destination" class="form-control" required>
                                        <option selected disabled>@lang('terminal.choose')</option>
                                        @foreach($terminals as $terminal)
                                        <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="name">@lang('route.name')</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="N01" required>
                                </div>
                                <div class="col-6">
                                    <label for="departure_time">@lang('route.departure_time')</label>
                                    <input type="time" id="departure_time" name="departure_time" class="form-control" required placeholder="07:20">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button class="btn btn-danger" type="submit">@lang('app.create')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection


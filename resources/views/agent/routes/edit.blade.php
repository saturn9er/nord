@extends('agent.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            <h2 class="font-weight-bold">@lang('route.edit')</h2>
            <div class="card">
                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        @lang('route.update_success')
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
                    <form method="post" action="{{ url('/agent/routes/$route->id') }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="departure">@lang('route.departure')</label>
                                    <select name="departure" id="departure" class="form-control" required></select>
                                </div>

                                <div class="col-6">
                                    <label for="destination">@lang('route.destination')</label>
                                    <select name="destination" id="destination" class="form-control" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label for="name">@lang('route.name')</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $route->name }}" required>
                                </div>
                                <div class="col-4">
                                    <label for="departure_time">@lang('route.departure_time')</label>
                                    <input type="time" id="departure_time" name="departure_time" class="form-control" required value="@time($route->departure_time)" min="4 "max="5">
                                </div>
                                <div class="col-4">
                                    <label for="arrival_time">@lang('route.arrival_time')</label>
                                    <input type="time" id="arrival_time" name="arrival_time" class="form-control" required value="@time($route->arrival_time)" min="4 "max="5">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button class="btn btn-danger" type="submit">@lang('app.save')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--suppress JSAnnotator -->
<script>
    $(document).ready(function(){
        $.get("{{ url('api/terminals') }}",
            function(data) {
                var destination = $('#destination');
                var departure   = $('#departure');
                $.each(data, function(index, element) {
                    if ({{ $route->departure }} == element.id) {
                        departure.append("<option value='"+ element.id +"' selected > " + element.short_name + " </option>");
                    } else {
                        departure.append("<option value='"+ element.id +"' > " + element.short_name + " </option>");
                    }
                });
                $.each(data, function(index, element) {
                    if ({{ $route->destination }} == element.id) {
                        destination.append("<option value='"+ element.id +"' selected > " + element.short_name + " </option>");
                    } else {
                        destination.append("<option value='"+ element.id +"' > " + element.short_name + " </option>");
                    }
                });
            });
    });
</script>
@endsection


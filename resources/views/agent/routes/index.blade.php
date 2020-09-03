@extends('agent.layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css">
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            <h2 class="font-weight-bold">@lang('route.routes')</h2>
            @if(Session::has('delete_success'))
            <div class="alert alert-success" role="alert">
                @lang('route.delete_success')
            </div>
            @endif
            @if(Session::has('delete_fail'))
            <div class="alert alert-danger" role="alert">
                @lang('route.delete_fail')
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="row text-right" style="margin-bottom: 15px;">
                        <div class="col">
                            <a class="btn btn-success btn-sm" href="{{ url('agent/routes/create') }}" role="button">@lang('app.create') <i class="fas fa-plus-circle"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered table-sm" style="font-size: 12px;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>@lang('route.route')</th>
                                        <th>@lang('route.departure')</th>
                                        <th>@lang('route.departure_time')</th>
                                        <th>@lang('route.destination')</th>
                                        <th>@lang('route.arrival_time')</th>
                                        <th>@lang('app.options')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($routes as $route)
                                    <tr>
                                        <td class="font-weight-bold">{{ $route->name }}</td>
                                        <td>{{ $route->departure }}</td>
                                        <td>@time($route->departure_time)</td>
                                        <td>{{ $route->destination }}</td>
                                        <td>@time($route->arrival_time)</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary btn-sm" title="@lang('app.edit')" href="{{ url('agent/routes/'.$route->id.'/edit') }}" role="button" style="border-radius: 0.25em;"><i class="fas fa-edit"></i></a>
                                                <form method="post" action="{{ url('agent/routes/'.$route->id) }}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button class="btn btn-danger btn-sm" title="@lang('app.delete')" role="button" onclick="return confirm('@lang('route.delete_alert')')" type="submit"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px;">
                <div class="col-xl-8 col-12">
                    {{  $routes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--suppress JSAnnotator -->
@endsection


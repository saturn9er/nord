@extends('passenger.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            <h2 class="font-weight-bold">@lang('passenger.edit')</h2>
            <div class="card">
                <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        @lang('passenger.success')
                    </div>
                    @endif
                    @if(Session::has('password_success'))
                    <div class="alert alert-success" role="alert">
                        @lang('passenger.password_success')
                    </div>
                    @endif
                    <form method="post" action="{{ url('/passenger') }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="name">@lang('passenger.name')</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ $passenger->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('passenger.e-mail')</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ $passenger->email }}">
                        </div>
                        <div class="form-group">
                            <label for="name">@lang('passenger.password')</label>
                            <input type="text" id="password" name="password" class="form-control" minlength="6" maxlength="191">
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button class="btn btn-danger" type="submit">@lang('passenger.apply')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--suppress JSAnnotator -->
@endsection


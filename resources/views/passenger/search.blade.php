@extends('passenger.layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            @guest
            <h3 class="font-weight text-center" style="margin-bottom: 30px;">@lang('search.message')</h3>
            @endguest
            <h2 class="font-weight-bold">@lang('search.ticket_search')</h2>
            <div class="card">
                <div class="card-body">
                    @guest
                    <form method="get" action="{{ url('/tickets/search') }}">
                    @endguest
                    @auth('passenger')
                    <form method="get" action="{{ url('passenger/tickets/search') }}">
                    @endauth
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col">
                                <label class="font-weight-bold" for="origin">@lang('search.from')</label>
                                <select name="departure" id="origin" class="form-control" required>
                                    <option selected disabled>@lang('search.choose_origin')</option>
                                    @foreach ($terminals as $terminal)
                                    <option value="{{ $terminal->id }}">{{ $terminal->short_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id = "destination-box" class="col">
                                <label class="font-weight-bold" for="destination">@lang('search.to')</label>
                                <select name="destination" id="destination" class="form-control" required>
                                </select>
                            </div>
                        </div>
                        <div class="form-row" style="margin-bottom: 20px;">
                            <div class="col-6" id="datepicker-container">
                                <label class="font-weight-bold" for="datepicker">@lang('search.when')</label>
                                <div class="input-group date" id="datepicker">
                                    <input name="date" type="text" class="form-control" id="datepicker-input" style="border-radius: .25rem;" required>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6" id="datepicker-container">
                                <label class="font-weight-bold" for="passengers-count">@lang('search.passengers')</label>
                                <select name="passengers" id="passengers-count" class="form-control" required>
                                    @for ($i = 1; $i < 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <input class="btn btn-danger btn-lg btn-block font-weight-bold" type="submit" value="@lang('search.find')">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.ru.min.js"></script>
<script>
    $( "#destination-box" ).hide();
    jQuery(document).ready(function($){
        $('#datepicker').datepicker({
            format: "dd-mm-yyyy",
            startDate: '0',
            endDate: '+3m',
            language: "ru",
            maxViewMode: 0
        });
        $('#origin').change(function(){
            $( "#destination-box" ).show();
            $.get("{{ url('api/terminals/').'/'}}"+$(this).val()+"/destinations",
                function(data) {
                    var destination = $('#destination');
                    destination.empty();

                    $.each(data, function(index, element) {
                        destination.append("<option value='"+ element.id +"'>" + element.short_name + "</option>");
                    });
                });
        });
    });
</script>
@endsection

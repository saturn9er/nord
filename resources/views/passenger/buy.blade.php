@extends('passenger.layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
            @guest
            <div class="alert alert-danger" role="alert">
                <a href="{{ url('/passenger/login') }}">@lang('buy.login')</a> @lang('buy.or') <a href="{{ url('/passenger/register') }}">@lang('buy.register')</a> @lang('buy.to_continue')
            </div>
            @endguest
            <div class="card" style="margin-top: 10px; background-color: #f9f9f2;">
                <div class="card-body">
                    <div class="form-row" style="margin-bottom: 10px;">
                        <span class="badge badge-warning">{{ $ticket[0]->route }}</span>
                        @if($ticket[0]->seats_left < 5)
                        <span class="badge badge-danger">@lang('search.few_tickets')</span>
                        @endif
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <h4 class="font-weight-bold"> {{ date_create($ticket[0]->departure_time)->format('H:i') }}</h4>
                            <h6>{{ $ticket[0]->departure }}</h6>
                        </div>
                        <div class="col-6 text-right">
                            <h4 class="font-weight-bold"> {{ date_create($ticket[0]->arrival_time)->format('H:i') }}</h4>
                            <h6>{{ $ticket[0]->destination }}</h6>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row" style="margin-bottom: -10px;">
                        <div class="col-12 text-right">
                            <small>@lang('search.baggage')</small>
                        </div>
                    </div>
                </div>
            </div>

            @auth
            <form method="post" action="{{ url('passenger/tickets/buy') }}">
                <input name="_token" value="{{ csrf_token() }}" hidden>
                <input name="trip" value="{{ $request->trip }}" hidden>
                <input name="passengers" value="{{ $request->passengers }}" hidden>
                <input name="promocode" id="promocode" value="" hidden>
                @for($i = 0; $i < $request->passengers; $i++)
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <h5 class="font-weight-bold">@lang('buy.passenger'){{ $i+1 }}</h5>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fullname">@lang('buy.fullname')</label>
                                    <input name="fullname[]" type="text" class="form-control" id="fullname" placeholder="@lang('buy.fullname_placeholder')" minlength="6" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="document_type">@lang('buy.doc_type')</label>
                                    <select name = "document_type[]" class="form-control" id="document_type" minlength="6" required>
                                        @foreach($document_types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="document_number">@lang('buy.doc_no')</label>
                                    <input name="document_number[]" type="text" class="form-control" id="document_number" placeholder="@lang('buy.doc_no_placeholder')" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <h5 class="font-weight-bold">@lang('buy.payment')<img src="https://forestschools.com/wp-content/uploads/2017/09/credit-cards.png" height="30px;"></h5>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="card-number">@lang('buy.card_no')</label>
                                    <input name="card-number" type="text" class="form-control" id="card-number" placeholder="0000 0000 0000 0000" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="holder-name">@lang('buy.holder_name')</label>
                                    <input name="holder-name" type="text" class="form-control" id="holder-name" placeholder="@lang('buy.holder_name_placeholder')" >
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="card-number">@lang('buy.expires')</label>
                                    <input name="card-number" type="text" class="form-control" maxlength="5" id="card-number" placeholder="MM/YY" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cv-code">@lang('buy.cvv/cvc')</label>
                                    <input name="cv-code" type="text" class="form-control" id="cv-code" placeholder="000" >
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12 col-xl-6">
                                <label for="promocode-group">@lang('buy.promo_code')</label>
                                <div class="form-group input-group" id="promocode-group">
                                    <input type="text" class="form-control" id="promocode-field" minlength="6" maxlength="6" value="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-warning" id="promocode-button" type="button" style="border-radius: 0 .25em .25em 0">@lang('buy.activate')</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group text-right">
                                    <h4 class="font-weight-bold">@lang('buy.total'): <span id="total">{{ intval($ticket[0]->price)*intval($request['passengers']) }}</span>₽</h4>
                                    <h6>@lang('buy.discount'): <span id="discount">0</span>₽</h6>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <input class="btn btn-primary btn-lg btn-block font-weight-bold btn-danger" type="submit" value="@lang('buy.pay')">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @endauth
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--suppress JSAnnotator -->
<script>
    jQuery(document).ready(function($){
        $('#promocode-button').click(function(){
            $.get("{{ url('api/promocodes')}}/"+$('#promocode-field').val(),
                function(data) {
                        if(data.issued_to == {{ Auth::id() }}){
                        $('#discount').text(data.discount);
                        var newTotal = {{ intval($ticket[0]->price) * intval($request->passengers) }} - data.discount;
                        if(newTotal < 0) { newTotal = 0; }
                        $('#total').text(newTotal);
                        $('#promocode').attr('value', $('#promocode-field').val());
                    }
                });
        });
    });
</script>
@endsection


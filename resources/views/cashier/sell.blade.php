@extends('cashier.layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-12">
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
            <form method="post" action="{{ url('cashier/tickets/sell') }}">
                <input name="_token" value="{{ csrf_token() }}" hidden>
                <input name="trip" value="{{ $request->trip }}" hidden>
                <input name="passengers" value="{{ $request->passengers }}" hidden>
                <input name="promocode" id="promocode" value="" hidden>
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <h5 class="font-weight-bold">Данные пассажира</h5>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fullname">@lang('buy.fullname')</label>
                                    <input name="fullname" type="text" class="form-control" id="fullname" placeholder="@lang('buy.fullname_placeholder')" minlength="6" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="document_type">@lang('buy.doc_type')</label>
                                    <select name = "document_type" class="form-control" id="document_type" minlength="6" required>
                                        @foreach($document_types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="document_number">@lang('buy.doc_no')</label>
                                    <input name="document_number" type="text" class="form-control" id="document_number" placeholder="@lang('buy.doc_no_placeholder')" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group text-right">
                                    <h4 class="font-weight-bold">@lang('buy.total'): <span id="total">{{ intval($ticket[0]->price)*intval($request['passengers']) }}</span>₽</h4>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <input class="btn btn-primary btn-lg btn-block font-weight-bold btn-danger" type="submit" value="Продать">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @endauth
        </div>
    </div>
</div>
@endsection


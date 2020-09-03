@extends('passenger.layouts.app')

@section('content')
<style>
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2 class="font-weight-bold">@lang('help.help')</h2>
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="list-group" id="list-tab" role="tablist" style="margin-bottom: 10px;">
                        <a class="list-group-item list-group-item-action active" id="list-buy_a_ticket-list" data-toggle="list" href="#list-buy_a_ticket" role="tab" aria-controls="buy_a_ticket">@lang('help.buy_a_ticket')</a>
                        <a class="list-group-item list-group-item-action" id="list-return_a_ticket-list" data-toggle="list" href="#list-return_a_ticket" role="tab" aria-controls="return_a_ticket">@lang('help.return_a_ticket')</a>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-buy_a_ticket" role="tabpanel" aria-labelledby="list-buy_a_ticket-list"><h3 class="font-weight-bold">@lang('help.buy_a_ticket')</h3>@lang('help.buy_a_ticket_content')</div>
                        <div class="tab-pane fade" id="list-return_a_ticket" role="tabpanel" aria-labelledby="list-return_a_ticket-list"><h3 class="font-weight-bold">@lang('help.return_a_ticket')</h3>@lang('help.return_a_ticket_content')</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

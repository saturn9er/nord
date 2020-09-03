<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('cashier')->user();

    //dd($users);

    return redirect('cashier/tickets/');
})->name('cashier.home');

Route::group(['prefix' => 'tickets'], function () {
    Route::get('/', 'Search\TicketSearchController@index');
    Route::get('/search', 'Search\TicketSearchController@search');
    Route::get('/sell', 'Buy\TicketBuyController@show');
    Route::post('/sell', 'Buy\TicketBuyController@sell');
    Route::get('/{id}/print', 'TicketPrintController@show')->where('id', '[0-9]+');
});

Route::get('/schedule/{terminalID?}', 'ScheduleController@show')->where('id', '[0-9]+');
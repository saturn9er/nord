<?php

Route::get('/', 'TicketController@show');
Route::put('/', 'PassengerController@update');

Route::get('/home', 'TicketController@show')->name('home');

Route::get('/help', 'Help\PassengerHelpController');

Route::group(['prefix' => 'tickets'], function () {
    Route::get('/', 'Search\TicketSearchController@index');
    Route::get('/search', 'Search\TicketSearchController@search');
    Route::get('/buy', 'Buy\TicketBuyController@show');
    Route::post('/buy', 'Buy\TicketBuyController@buy');
    Route::get('/{id}/print', 'TicketPrintController@show')->where('id', '[0-9]+');
    Route::get('/{id}/return', 'TicketReturnController')->where('id', '[0-9]+');
});

Route::get('/schedule/{terminalID?}', 'ScheduleController@show')->where('id', '[0-9]+');

Route::get('/edit', 'PassengerController@edit');



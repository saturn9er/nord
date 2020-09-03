<?php

Route::get('/home', function () {
    return view('agent.home');
})->name('home');

Route::get('/reports/trips/{date?}', 'Report\TripsReportController');
Route::get('/reports/tickets/{date?}', 'Report\TicketsReportController');

Route::get('/schedule/{terminalID?}', 'ScheduleController@show')->where('terminalID', '[0-9]+')->name('schedule');

Route::resource('routes', 'RouteController');

Route::group(['prefix' => 'users'], function () {
    Route::resource('agents', 'AgentController');
    Route::resource('cashiers', 'CashierController');
    Route::resource('passengers', 'PassengerController');
});


Route::group(['prefix' => 'trips'], function () {
    Route::get('/active/{terminalID?}', 'Trip\ActiveTripController')->where('terminalID', '[0-9]+');
    Route::get('/approve', 'Trip\ApproveTripController');
    Route::get('/archival', 'Trip\ArchivalTripController');
    Route::get('/{id}/print', 'Trip\PrintTripController')->where('id', '[0-9]+');
});

Route::resource('trips', 'TripController');



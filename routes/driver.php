<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('driver')->user();

    //dd($users);

    return view('driver.home');
})->name('home');

Route::group(['prefix' => 'boarding'], function(){
    Route::get('/', 'BoardingController@show');
    Route::get('/check', 'BoardingController@check');
    Route::get('/finish', 'BoardingController@finish');
});

Route::group(['prefix' => 'trip'], function(){
    Route::get('/', 'TripController@show');
    Route::get('/finish', 'TripController@finish');
});

Route::get('/schedule/{terminalID?}', 'ScheduleController@show')->where('id', '[0-9]+')->name('schedule');



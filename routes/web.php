<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Ticket;
use App\Services\TicketReturnService as Service;

Route::group(['middleware' => 'passenger.guest'], function () {
    Route::get('/', 'Search\TicketSearchController@index');
    Route::get('/tickets/search', 'Search\TicketSearchController@search');
    Route::get('/tickets/buy', 'Buy\TicketBuyController@show');
    Route::get('/schedule/{terminalID?}', 'ScheduleController@show')->where('id', '[0-9]+')->name('schedule');

});

Route::get('/test', function () {
    $tickets = Ticket::select('tickets.id')->join('trips', 'trips.id', '=', 'tickets.trip_id')->where('trips.status_id', '=', 6)->where('tickets.returned', 0)->get();
    foreach ($tickets as $ticket){
        Service::returnTicket($ticket->id);
    }
});

Route::group(['prefix' => 'promocodes'], function(){
    Route::get('/', 'PromoCodeController@index');
    Route::get('/{promocode}', 'PromoCodeController@show')->where('promocode', '[a-zA-Z0-9]{6}');
});

Route::group(['prefix' => 'agent'], function () {
    Route::get('/login', 'AgentAuth\LoginController@showLoginForm')->name('agent.login');
    Route::post('/login', 'AgentAuth\LoginController@login');
    Route::post('/logout', 'AgentAuth\LoginController@logout')->name('agent.logout');

    Route::get('/register', 'AgentAuth\RegisterController@showRegistrationForm')->name('agent.register');
    Route::post('/register', 'AgentAuth\RegisterController@register');

    Route::post('/password/email', 'AgentAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'AgentAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'AgentAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'AgentAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'cashier'], function () {
  Route::get('/login', 'CashierAuth\LoginController@showLoginForm')->name('cashier.login');
  Route::post('/login', 'CashierAuth\LoginController@login');
  Route::post('/logout', 'CashierAuth\LoginController@logout')->name('cashier.logout');

  Route::get('/register', 'CashierAuth\RegisterController@showRegistrationForm')->name('cashier.register');
  Route::post('/register', 'CashierAuth\RegisterController@register');

  Route::post('/password/email', 'CashierAuth\ForgotPasswordController@sendResetLinkEmail')->name('cashier.password.request');
  Route::post('/password/reset', 'CashierAuth\ResetPasswordController@reset')->name('cashier.password.email');
  Route::get('/password/reset', 'CashierAuth\ForgotPasswordController@showLinkRequestForm')->name('cashier.password.reset');
  Route::get('/password/reset/{token}', 'CashierAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'driver'], function () {
    Route::get('/login', 'DriverAuth\LoginController@showLoginForm')->name('driver.login');
    Route::post('/login', 'DriverAuth\LoginController@login');
    Route::post('/logout', 'DriverAuth\LoginController@logout')->name('driver.logout');

    Route::get('/register', 'DriverAuth\RegisterController@showRegistrationForm')->name('driver.register');
    Route::post('/register', 'DriverAuth\RegisterController@register');

    Route::post('/password/email', 'DriverAuth\ForgotPasswordController@sendResetLinkEmail')->name('driver.password.request');
    Route::post('/password/reset', 'DriverAuth\ResetPasswordController@reset')->name('driver.password.email');
    Route::get('/password/reset', 'DriverAuth\ForgotPasswordController@showLinkRequestForm')->name('driver.password.reset');
    Route::get('/password/reset/{token}', 'DriverAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'passenger'], function () {
    Route::get('/login', 'PassengerAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'PassengerAuth\LoginController@login');
    Route::post('/logout', 'PassengerAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'PassengerAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'PassengerAuth\RegisterController@register');

    Route::post('/password/email', 'PassengerAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'PassengerAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'PassengerAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'PassengerAuth\ResetPasswordController@showResetForm');
});



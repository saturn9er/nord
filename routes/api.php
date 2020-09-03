<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'terminals'], function(){
    Route::get('/', 'TerminalController@index');
    Route::get('/{id}/destinations', 'TerminalController@destinations');
});

Route::group(['prefix' => 'promocodes'], function(){
    Route::get('/', 'PromoCodeController@index');
    Route::get('/{promocode}', 'PromoCodeController@show')->where('promocode', '[a-zA-Z0-9]{6}');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index');
        Route::post('/store', 'UserController@store');
        Route::get('/{id}/show', 'UserController@show');
        Route::put('/{id}/update', 'UserController@update');
        Route::delete('{id}/delete', 'UserController@destroy');
    });
});

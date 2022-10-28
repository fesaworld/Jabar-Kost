<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:Super Admin',
], function() {
    Route::get('/token', 'TokenController@index');
    Route::get('/token/{id}', 'TokenController@show');
    Route::post('/token', 'TokenController@store');
    Route::delete('/token/{id}', 'TokenController@destroy');
});

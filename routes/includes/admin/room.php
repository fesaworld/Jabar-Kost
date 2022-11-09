<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:Super Admin|User',
], function() {
    Route::get('/room', 'RoomController@index');
    Route::get('/room/{id}', 'RoomController@show');
    Route::post('/room', 'RoomController@store');
    Route::post('/room/{id}', 'RoomController@update');
    Route::delete('/room/{id}', 'RoomController@destroy');
    Route::post('/roomImport','RoomController@import');
});

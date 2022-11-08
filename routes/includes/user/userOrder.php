<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:User',
], function() {
    Route::get('/userOrder', 'UserOrderController@index');
    Route::get('/userOrder/{id}', 'UserOrderController@show');
    Route::post('/userOrder', 'UserOrderController@store');
});

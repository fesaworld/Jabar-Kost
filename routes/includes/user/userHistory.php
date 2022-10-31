<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:User',
], function() {
    Route::get('/userHistory', 'UserHistoryController@index');
    Route::get('/userHistory/{id}', 'UserHistoryController@show');
});

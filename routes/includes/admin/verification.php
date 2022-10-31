<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:Super Admin',
], function() {
    Route::get('/verification', 'VerificationController@index');
    Route::get('/verification/{id}', 'VerificationController@show');
    Route::post('/verification', 'VerificationController@store');
    Route::post('/verification/{id}', 'VerificationController@update');
    Route::delete('/verification/{id}', 'VerificationController@destroy');
});

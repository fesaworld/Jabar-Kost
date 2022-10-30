<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:User',
], function() {
    Route::get('/userProfile', 'UserProfileController@index');
    Route::get('/userProfile/{id}', 'UserProfileController@show');
    Route::post('/userProfile', 'UserProfileController@store');
    Route::post('/userProfile/{id}', 'UserProfileController@update');
    Route::delete('/userProfile/{id}', 'UserProfileController@destroy');
});

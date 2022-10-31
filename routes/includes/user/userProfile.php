<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:User',
], function() {
    Route::get('/userProfile', 'UserProfileController@index');
    Route::post('/userProfile/{id}', 'UserProfileController@update');
});

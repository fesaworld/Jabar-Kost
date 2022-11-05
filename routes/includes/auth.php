<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'guest',
], function() {
    // buat login
    Route::get('/login', 'AuthController@viewLogin')->name('login');
    Route::post('/login', 'AuthController@login');

    //buat register
    Route::get('/register', 'AuthController@viewRegister')->name('register');
    Route::post('/register', 'AuthController@register');
});

Route::group([
    'middleware' => 'auth',
], function() {
    Route::get('/logout', 'AuthController@logout');
});

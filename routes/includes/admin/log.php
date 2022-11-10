<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:Super Admin',
], function () {
    Route::get('/log','LogController@index');
    Route::get('/log/export','LogController@export');
}
);
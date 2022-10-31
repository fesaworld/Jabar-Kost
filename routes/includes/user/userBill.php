<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:User',
], function() {
    Route::get('/userBill', 'UserBillController@index');
    Route::post('/userBill/{id}', 'UserBillController@update');
});

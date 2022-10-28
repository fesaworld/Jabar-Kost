<?php

use Illuminate\Support\Facades\Route;

Route::get('/userBill', 'UserBillController@index');
Route::get('/userBill/{id}', 'UserBillController@show');
Route::post('/userBill', 'UserBillController@store');
Route::post('/userBill/{id}', 'UserBillController@update');
Route::delete('/userBill/{id}', 'UserBillController@destroy');

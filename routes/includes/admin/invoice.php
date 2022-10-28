<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:Super Admin',
], function() {
    Route::get('/invoice', 'InvoiceController@index');
    Route::get('/invoice/{id}', 'InvoiceController@show');
    Route::post('/invoice', 'InvoiceController@store');
    Route::post('/invoice/{id}', 'InvoiceController@update');
    Route::post('/invoiceStatus/{id}', 'InvoiceController@updateStatus');
    Route::delete('/invoice/{id}', 'InvoiceController@destroy');
});

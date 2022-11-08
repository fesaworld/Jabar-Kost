<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'role:Super Admin|User',
], function() {
    Route::get('/userBillPrint/{id}', 'PrintController@userBillPrint');
});

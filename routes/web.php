<?php

use Illuminate\Support\Facades\Route;

require_once('includes/auth.php');

Route::group([
    'middleware' => 'auth',
], function() {
    require_once('includes/dashboard.php');
    require_once('includes/admin/token.php');
    require_once('includes/admin/room.php');
    require_once('includes/admin/invoice.php');

    require_once('includes/user/userBill.php');
});


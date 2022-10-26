<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userAktif = User::where('name','<>', 'super admin')
                    ->where('deleted_at', NULL)
                    ->count();

        return view('pages.dashboard', compact('userAktif') );
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\ReferralCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Auth::user()->detail->image

        $userAktif = User::where('name','<>', 'super admin')
                    ->where('deleted_at', NULL)
                    ->count();

        $kamarTersedia = Room::count();

        $tokenNonAktif = ReferralCode::where('status', 'Non-Aktif')->count();

        $tokenAktif = ReferralCode::where('status', 'Aktif')->count();

        $data = [
            'tokenAktif' => $tokenAktif,
            'tokenNonAktif' => $tokenNonAktif,
            'kamarTersedia' => $kamarTersedia,
            'userAktif' => $userAktif,
            'script' => 'components.scripts.dashboard'
        ];

        return view('pages.dashboard', $data);
    }
}

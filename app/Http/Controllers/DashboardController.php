<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Invoice;
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

        $kamarTersedia = Room::sum('stok');

        $tokenNonAktif = ReferralCode::where('status', 'Non-Aktif')->count();

        $tokenAktif = ReferralCode::where('status', 'Aktif')->count();

        $bulan = date('F');

        $pemasukan = Invoice::where('status', 'Aktif')->whereMonth('created_at', date('m'))->sum('total_price');
        $pemasukan = number_format($pemasukan);

        $tunggakan = Invoice::where('status', 'Non-Aktif')->whereMonth('created_at', date('m'))->sum('total_price');
        $tunggakan = number_format($tunggakan);

        $data = [
            'bulan'         => $bulan,
            'tunggakan'     => $tunggakan,
            'pemasukan'     => $pemasukan,
            'tokenAktif'    => $tokenAktif,
            'tokenNonAktif' => $tokenNonAktif,
            'kamarTersedia' => $kamarTersedia,
            'userAktif'     => $userAktif,
            'script'        => 'components.scripts.dashboard'
        ];

        return view('pages.dashboard', $data);
    }
}

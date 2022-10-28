<?php

namespace App\Http\Controllers;

use App\User;
use App\Room;
use App\Invoice;
use App\ReferralCode;
use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Auth::user()->detail->image
        //return Carbon::createFromTimeStamp(strtotime($row->end))->diffForHumans();

        $bulan = date('F');

// Buat Dashboard ADMINISTRATOR

        if(Auth::user()->getRoleNames()[0] == 'Super Admin') {
            $userAktif = User::where('name','<>', 'super admin')
                    ->where('deleted_at', NULL)
                    ->count();

            $kamarTersedia = Room::sum('stok');

            $tokenNonAktif = ReferralCode::where('status', 'Non-Aktif')->count();

            $tokenAktif = ReferralCode::where('status', 'Aktif')->count();

            $pemasukan = Invoice::where('status', 'Aktif')->whereMonth('created_at', date('m'))->sum('total_price');
            $pemasukan = number_format($pemasukan);

            $tunggakan = Invoice::where('status', 'Non-Aktif')->whereMonth('created_at', date('m'))->sum('total_price');
            $tunggakan = number_format($tunggakan);

            $data = [
                // Buat Dashboard ADMINISTRATOR
                'bulan'         => $bulan,
                'tunggakan'     => $tunggakan,
                'pemasukan'     => $pemasukan,
                'tokenAktif'    => $tokenAktif,
                'tokenNonAktif' => $tokenNonAktif,
                'kamarTersedia' => $kamarTersedia,
                'userAktif'     => $userAktif,

                'script'        => 'components.scripts.dashboard'
            ];

        } else {

            // Buat Dashboard User

            $dataInv = Invoice::where('user_id', Auth::user()->id)->first();

            if ($dataInv->status == 'Aktif') {$dataTagihan = 0;
            }else{$dataTagihan = number_format($dataInv->total_price);}


            $start = new DateTime(date('d-m-Y', strtotime($dataInv->start)));
            $end = new DateTime(date('d-m-Y', strtotime($dataInv->end)));
            $datediff = $end->diff($start);
            $totalBulan = $datediff->days / 31;
            $totalBulan = ceil($totalBulan);


            $hargaSewa = number_format($dataInv->toRoom->price);
            $namaKamar = $dataInv->toRoom->name;
            $sisaTempo = Carbon::createFromTimeStamp(strtotime($dataInv->end))->diffForHumans();
            ;
            $lamaSewa = $totalBulan;

            $data = [
                // Buat Dashboard User
                'sisaTempo' => $sisaTempo,
                'lamaSewa'  => $lamaSewa,
                'bulan'     => $bulan,
                'dataTagihan' => $dataTagihan,
                'hargaSewa' => $hargaSewa,
                'namaKamar' => $namaKamar,

                'script'        => 'components.scripts.dashboard'
            ];
        }

        return view('pages.dashboard', $data);
    }
}

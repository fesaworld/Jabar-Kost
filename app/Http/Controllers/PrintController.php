<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use PDF;
use DateTime;

class PrintController extends Controller
{
    //Buat User
    public function userBillPrint($id)
    {
        // $dataDetail = UserDetail::with('detailToUser')->where('user_id', Auth::user()->id)->first();

        $invoice = Invoice::with('toUser', 'toRoom')->Where('id', $id)->first();

        $start = new DateTime(date('d-m-Y', strtotime($invoice->start)));
        $end = new DateTime(date('d-m-Y', strtotime($invoice->end)));
        $datediff = $end->diff($start);
        $totalBulan = $datediff->days / 31;
        $totalBulan = ceil($totalBulan);

        $diskon = (($invoice->toRoom->price * $totalBulan) / 100) * $invoice->discount;

        $data = [
            // Buat Dashboard User
            'invoice'    => $invoice,
            'totalBulan' => $totalBulan,
            'diskon'     => $diskon,
        ];

//dd($invoice);
        $pdf = PDF::loadview('pages.print.userBillPrint', $data)->setPaper('a4', 'portrait');
        return $pdf->stream('invoice.pdf');
    }
}

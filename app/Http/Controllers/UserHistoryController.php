<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class UserHistoryController extends Controller
{
    public function index()
    {
        $data = [
            'script' => 'components.scripts.user.userHistory'
        ];

        return view('pages.user.userHistory', $data);
    }

    public function show($id)
    {
        $data = Invoice::where('user_id', Auth::user()->id)->with('toUser', 'toRoom')->orderBy('id', 'desc')->get();

        return DataTables::of($data)

            ->editColumn('trf_image', function($row){
                $data = array('image' => $row->trf_image);

                return view('components.images.images', $data);
            })

            ->editColumn(
                'user_id',
                function(Invoice $invoice) {
                    return $invoice->toUser->name;
                }
            )

            ->editColumn(
                'room_id',
                function(Invoice $invoice) {
                    return $invoice->toRoom->name;
                }
            )

            ->editColumn(
                'created_at',
                function($row) {
                    return date('d F Y', strtotime($row->created_at));
                }
            )

            ->editColumn(
                'start',
                function($row) {
                    return date('d F Y', strtotime($row->start));
                }
            )

            ->editColumn(
                'end',
                function($row) {
                    return date('d F Y', strtotime($row->end));
                }
            )

            ->editColumn(
                'discount',
                function($row) {
                    return number_format($row->discount).'%';
                }
            )

            ->editColumn(
                'price',
                function($row) {
                    return number_format($row->total_price);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }
}

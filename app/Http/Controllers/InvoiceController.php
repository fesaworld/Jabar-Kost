<?php

namespace App\Http\Controllers;

use DateTime;
use App\User;
use App\Room;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index()
    {

        $exclude = [];
        $id = Invoice::get();
        foreach($id as $userId) {
            $exclude[] = $userId->user_id;
        }
        $getUser = User::where('id', '<>', Auth::user()->id)->whereNotIn('id', $exclude)->get();


        $getRoom = Room::where('stok', '<>', 0)->get();

        $data = [
            'getUser' => $getUser,
            'getRoom' => $getRoom,
            'script' => 'components.scripts.admin.invoice'
        ];

        return view('pages.admin.invoice', $data);
    }

    public function show($id)
    {
        if(is_numeric($id))
        {
            // date('d-m-Y', strtotime($data->start))
            // new DateTime(date('d-m-Y', strtotime($data->start)));

            $data = Invoice::where('id', $id)->first();
            $data->start = date('Y-m-d', strtotime($data->start));
            $data->end = date('Y-m-d', strtotime($data->end));
            $data->total_price = number_format($data->total_price);
            $data->discount = number_format($data->discount);

            $data->name = User::where('id', $data->user_id)->first()->name;

            return Response::json($data);

            dd();
        }

        $data = Invoice::with('toUser', 'toRoom')->orderBy('id', 'desc')->get();

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
                'start',
                function($row) {
                    return date('d-m-Y', strtotime($row->start));
                }
            )

            ->editColumn(
                'end',
                function($row) {
                    return date('d-m-Y', strtotime($row->end));
                    //return Carbon::createFromTimeStamp(strtotime($row->end))->diffForHumans();
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

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id
                    ];

                    return view('components.buttons.invoice', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        if($request->invName == 'Pilih Nama Penyewa') {
            $json = [
                'msg'       => 'Mohon pilih nama penyewa',
                'status'    => false
            ];
        } elseif($request->invRoom == 'Pilih Tipe Kamar') {
            $json = [
                'msg'       => 'Mohon pilih tipe kamar',
                'status'    => false
            ];
        } elseif($request->invStart == NULL) {
                $json = [
                    'msg'       => 'Mohon pilih waktu mulai sewa',
                    'status'    => false
                ];
        } elseif($request->invEnd == NULL) {
            $json = [
                'msg'       => 'Mohon pilih waktu akhir sewa',
                'status'    => false
            ];
        } elseif($request->invStart == $request->invEnd) {
            $json = [
                'msg'       => 'Waktu mulai sewa dan akhir sewa tidak boleh sama',
                'status'    => false
            ];
        } else {

            if($request->invDisc == NULL)
            {$request->invDisc = 0;}

            $getRoom = Room::where('id', $request->invRoom)->first();
            $start = new DateTime(date('d-m-Y', strtotime($request->invStart)));
            $end = new DateTime(date('d-m-Y', strtotime($request->invEnd)));
            $datediff = $end->diff($start);
            $totalBulan = $datediff->days / 31;
            $totalHarga = $getRoom->price * ceil($totalBulan);
            $totalDiskon = ($totalHarga / 100) * $request->invDisc;
            $totalHarga = $totalHarga - $totalDiskon;

            try{
                Invoice::create([
                    'user_id' => $request->invName,
                    'room_id' => $request->invRoom,
                    'start' => date('Y-m-d H-i-s', strtotime($request->invStart)),
                    'end' => date('Y-m-d H-i-s', strtotime($request->invEnd)),
                    'discount' => $request->invDisc,
                    'total_price' => $totalHarga,
                    'trf_image' => null,
                    'status' => 'Non-Aktif',
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                $json = [
                    'msg' => 'Data penyewa berhasil ditambahkan',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }
        }

        return Response::json($json);
    }

    public function update(Request $request, $id)
    {
        if($request->invEditRoom == 'Pilih Tipe Kamar') {
            $json = [
                'msg'       => 'Mohon pilih tipe kamar',
                'status'    => false
            ];
        } elseif($request->invEditStart == NULL) {
                $json = [
                    'msg'       => 'Mohon pilih waktu mulai sewa',
                    'status'    => false
                ];
        } elseif($request->invEditEnd == NULL) {
            $json = [
                'msg'       => 'Mohon pilih waktu akhir sewa',
                'status'    => false
            ];
        } elseif($request->invEditStart == $request->invEditEnd) {
            $json = [
                'msg'       => 'Waktu mulai sewa dan akhir sewa tidak boleh sama',
                'status'    => false
            ];
        } else {

            $getRoom = Room::where('id', $request->invEditRoom)->first();
            $start = new DateTime(date('d-m-Y', strtotime($request->invEditStart)));
            $end = new DateTime(date('d-m-Y', strtotime($request->invEditEnd)));
            $datediff = $end->diff($start);
            $totalBulan = $datediff->days / 31;
            $totalHarga = $getRoom->price * ceil($totalBulan);
            $totalDiskon = ($totalHarga / 100) * $request->invEditDisc;
            $totalHarga = $totalHarga - $totalDiskon;

            try{
                Invoice::whereId($id)->update([
                    'room_id' => $request->invEditRoom,
                    'start' => date('Y-m-d H-i-s', strtotime($request->invEditStart)),
                    'end' => date('Y-m-d H-i-s', strtotime($request->invEditEnd)),
                    'discount' => $request->invEditDisc,
                    'total_price' => $totalHarga,
                    'trf_image' => null,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                $json = [
                    'msg' => 'Data penyewa berhasil disunting',
                    'status' => true
                ];
            } catch(Exception $e) {
                $json = [
                    'msg'       => 'error',
                    'status'    => false,
                    'e'         => $e
                ];
            }
        }

        return Response::json($json);
    }

    public function updateStatus($id)
    {
        $data = Invoice::where('id', $id)->first()->status;

        $dataStok = Room::where('id', $id)->first();


        if($data == 'Aktif'){
            $data = 'Non-Aktif';
            $dataStok = $dataStok->stok + 1;
        } elseif ($data == 'Non-Aktif') {
            $data = 'Aktif';
            $dataStok = $dataStok->stok - 1;
        }

        try{
            Invoice::whereId($id)->update([
                'status' => $data,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            Room::whereId($id)->update([
                'stok' => $dataStok,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $json = [
                'msg' => 'Status menjadi : ' . $data,
                'status' => true
            ];
        } catch(Exception $e) {
            $json = [
                'msg'       => 'error',
                'status'    => false,
                'e'         => $e,
                'line'      => $e->getLine(),
                'message'   => $e->getMessage(),
            ];
        }

        return Response::json($json);
    }

    public function destroy($id)
    {
        $data = Room::where('id', $id)->first();
        $data = $data->stok + 1;

        try{
            Invoice::where('id',$id)->Delete();

            Room::whereId($id)->update([
                'stok' => $data,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $json = [
                'msg' => 'Data penyewa berhasil dihapus',
                'status' => true
            ];
        } catch(Exception $e){
            $json = [
                'msg' => 'error',
                'status' => false,
                'e' => $e,
            ];
        };

        return Response::json($json);
    }
}

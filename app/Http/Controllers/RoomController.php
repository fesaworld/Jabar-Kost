<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    public function index()
    {
        $data = [
            'script' => 'components.scripts.admin.room'
        ];

        return view('pages.admin.room', $data);
    }

    public function show($id)
    {
        if(is_numeric($id))
        {
            $data = Room::where('id', $id)->first();
            $data->price = number_format($data->price);

            return Response::json($data);
        }

        $data = Room::orderBy('id', 'desc')->get();

        return DataTables::of($data)

            ->editColumn(
                'stok',
                function($row) {
                    return $row->stok.' Kamar';
                }
            )

            ->editColumn(
                'price',
                function($row) {
                    return number_format($row->price);
                }
            )

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id
                    ];

                    return view('components.buttons.room', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        if($request->roomName == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama kamar',
                'status'    => false
            ];
        } elseif($request->roomPrice == NULL) {
            $json = [
                'msg'       => 'Mohon masukan harga kamar',
                'status'    => false
            ];
        } elseif($request->roomStock == NULL || $request->roomStock == "0") {
            if($request->roomStock == NULL){
                $json = [
                    'msg'       => 'Mohon masukan jumlah kamar',
                    'status'    => false
                ];
            }else{
                $json = [
                    'msg'       => 'Minimal jumlah kamar 1',
                    'status'    => false
                ];
            }
        }elseif($request->roomDetail == NULL) {
            $json = [
                'msg'       => 'Mohon masukan detail kamar',
                'status'    => false
            ];
        }else {
            try{

                Room::create([
                    'name' => $request->roomName,
                    'price' => str_replace(',','',$request->roomPrice),
                    'stok' => $request->roomStock,
                    'detail' => $request->roomDetail,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $json = [
                    'msg' => 'Data Kamar berhasil ditambahkan',
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
        if($request->roomNameEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan nama kamar',
                'status'    => false
            ];
        } elseif($request->roomPriceEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan harga kamar',
                'status'    => false
            ];
        } elseif($request->roomStockEdit == NULL || $request->roomStockEdit == "0") {
            if($request->roomStockEdit == NULL){
                $json = [
                    'msg'       => 'Mohon masukan jumlah kamar',
                    'status'    => false
                ];
            }else{
                $json = [
                    'msg'       => 'Minimal jumlah kamar 1',
                    'status'    => false
                ];
            }
        }elseif($request->roomDetailEdit == NULL) {
            $json = [
                'msg'       => 'Mohon masukan detail kamar',
                'status'    => false
            ];
        }else {
            try{
                Room::whereId($id)->update([
                    'name' => $request->roomNameEdit,
                    'price' => str_replace(',','',$request->roomPriceEdit),
                    'stok' => $request->roomStockEdit,
                    'detail' => $request->roomDetailEdit,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                $json = [
                    'msg' => 'Data Kamar berhasil disunting',
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

    public function destroy($id)
    {
        // $token = ReferralCode::where('id', $id)->first()->status;

        // if($token == 'aktif') {
        //     return Response::json([
        //        'msg' => 'Data token aktif tidak bisa dihapus',
        //        'status' => false
        //     ]);
        // }else{
            try{

                Room::where('id',$id)->Delete();

                $json = [
                    'msg' => 'Token berhasil dihapus',
                    'status' => true
                ];
            } catch(Exception $e){
                $json = [
                    'msg' => 'error',
                    'status' => false,
                    'e' => $e,
                ];
            };
        // }
        return Response::json($json);
    }
}

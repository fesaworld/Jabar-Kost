<?php

namespace App\Http\Controllers;

use App\Room;
use Exception;
use App\Imports\RoomImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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

        ->editColumn('image', function($row){
            $data = array('image' => $row->image);

            return view('components.images.room', $data);
        })

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

                if($request->file('roomImage'))
                {
                    $post_image = $request->file('roomImage');
                    $extension  = $post_image->getClientOriginalExtension();
                    $featuredImageName  = date('YmdHis').'.'.$extension;
                    $destination = base_path('public/assets/image/room');
                    $post_image->move($destination, $featuredImageName);
                } else { $featuredImageName = "";}

                Room::create([
                    'name' => $request->roomName,
                    'price' => str_replace(',','',$request->roomPrice),
                    'stok' => $request->roomStock,
                    'detail' => $request->roomDetail,
                    'image' => $featuredImageName,
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
            $dataImage = Room::where('id', $id)->first()->image;
            try{
                if($request->file('roomImageEdit'))
                {
                    $post_image = $request->file('roomImageEdit');
                    $fileName = Room::where('id', $id)->get()->first()->image;


                    if($fileName)
                    {
                        $pleaseRemove = base_path('public/assets/image/room').$dataImage;

                        if(file_exists($pleaseRemove)) {
                            unlink($pleaseRemove);
                        }
                    }

                    $extension  = $post_image->getClientOriginalExtension();
                    $featuredImageName  = date('YmdHis').'.'.$extension;
                    $destination = base_path('public/assets/image/room');
                    $post_image->move($destination, $featuredImageName);
                } else { $featuredImageName = $dataImage;}

                Room::whereId($id)->update([
                    'name' => $request->roomNameEdit,
                    'price' => str_replace(',','',$request->roomPriceEdit),
                    'stok' => $request->roomStockEdit,
                    'detail' => $request->roomDetailEdit,
                    'image' => $featuredImageName,
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
                    'msg' => 'Kamar berhasil dihapus',
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

    public function import(Request $request){
        try{

            if(count($request->file()) > 0)
            {
                $data = $request -> file('importData');
                Excel::import(new RoomImport,$data);
                //return redirect()->back();

                $json = [
                    'msg' => 'Import kamar berhasil',
                    'status' => true
                ];
            }else{
                $json = [
                    'msg' => 'Import kamar Gagal',
                    'status' => false,
                ];
            }
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
}

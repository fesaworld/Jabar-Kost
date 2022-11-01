<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDetail;
use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function index()
    {
        $data = [
            'script' => 'components.scripts.admin.verification'
        ];

        return view('pages.admin.verification', $data);
    }

    public function show($id)
    {
        if(is_numeric($id)) {

            $data = User::where('id', $id)->with('detail')->first();

            return Response::json($data);
        }

        $data = User::where('id','<>', '1')->with('detail')->orderBy('id', 'desc')->get();

        return DataTables::of($data)

            ->editColumn('detail.image', function($row){
                $data = array('image' => $row->detail->image);
                return view('components.images.profil', $data);
            })

            ->editColumn('detail.card_id', function($row){
                $data = array('image' => $row->detail->card_id);
                return view('components.images.idCard', $data);
            })

            ->editColumn(
                'detail.phone',
                function($row) {
                    if($row->detail->phone == NULL){return '-';}
                    else{return $row->detail->phone;}
                }
            )

            ->editColumn(
                'detail.gender',
                function($row) {
                    if($row->detail->gender == NULL){return '-';}
                    else{return $row->detail->gender;}
                }
            )

            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id
                    ];

                    return view('components.buttons.verification', $data);
                }
            )

            ->addIndexColumn()
            ->make(true);
    }

    public function update(Request $request, $id)
    {
        if($request->statusEdit == 'Ditolak'){

            $pleaseRemove = base_path('public/assets/image/idCard/'). $request->cardEditHidden;

            if(file_exists($pleaseRemove)) {
                unlink($pleaseRemove);
            }

            try{
                UserDetail::whereId($id)->update([
                    'card_id' => NULL,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            } catch(Exception $e){
                $json = [
                    'msg' => 'error',
                    'status' => false,
                    'e' => $e,
                ];
            };
        }
        try{
            UserDetail::whereId($id)->update([
                'status' => $request->statusEdit,
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
                'e'         => $e,
                'line'      => $e->getLine(),
                'message'   => $e->getMessage(),
            ];
        }
        return Response::json($json);
    }

    public function destroy($id)
    {
        $data = UserDetail::where('id', $id)->first();

        try{
            User::where('id', $data->user_id)->Delete();

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

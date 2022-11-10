<?php

namespace App\Http\Controllers;

use App\ReferralCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class TokenController extends Controller
{
    public function index()
    {
        $data = [
            'script' => 'components.scripts.admin.token'
        ];

        return view('pages.admin.token', $data);
    }

    public function show($id)
    {
        if(is_numeric($id))
        {
            $data = ReferralCode::where('id', $id)->first();

            return Response::json($data);
        }

        $data = ReferralCode::orderBy('id', 'desc')->get();

        return DataTables::of($data)
            ->addColumn(
                'action',
                function($row) {
                    $data = [
                        'id' => $row->id
                    ];

                    return view('components.buttons.token', $data);
                }
            )
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request)
    {
        do {
            $random = random_int(10000, 99999);
            $token = ReferralCode::where('token', $random)->first();
          } while ($token);

        try{

            ReferralCode::create([
                'created_at' => date('Y-m-d H:i:s'),
                'token' => $random,
                'status' => 'Non-Aktif',
            ]);

            $json = [
                'msg' => 'Token baru berhasil dibuat',
                'token' => $random,
                'status' => true
            ];
        } catch(Exception $e) {
            $json = [
                'msg'       => 'error',
                'status'    => false,
                'e'         => $e
            ];
        }

        return Response::json($json);
    }

    public function destroy($id)
    {
        $token = ReferralCode::where('id', $id)->first()->status;

        if($token == 'Aktif') {
            return Response::json([
               'msg' => 'Data token Aktif tidak bisa dihapus',
               'status' => false
            ]);
        }else{
            try{

                ReferralCode::where('id',$id)->forceDelete();

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
        }
        return Response::json($json);
    }
}

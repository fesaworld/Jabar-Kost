<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class UserBillController extends Controller
{
    public function index()
    {

        $id = Auth::user()->id;
        $data = Invoice::with('toUser', 'toRoom')->where('user_id', $id)->where('status', '<>', 'Selesai')->first();
        if($data != null)
        {
            $data->start = date('d F Y', strtotime($data->start));
            $data->end = date('d F Y', strtotime($data->end));
            $data->total_price = number_format($data->total_price);
            $data->discount = number_format($data->discount);
        }

        $data = [
            'data' => $data,
            'script' => 'components.scripts.user.userBill'
        ];

        return view('pages.user.userBill', $data);
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());

        if(!$request->file('imageTrf'))
        {
            $json = [
                'msg'       => 'Mohon masukkan bukti transfer',
                'status'    => false
            ];
        } else {
            $post_image = $request->file('imageTrf');
            $extension  = $post_image->getClientOriginalExtension();

            $featuredImageName  = date('YmdHis').'.'.$extension;
            $destination = base_path('public/assets/image/buktiTrf/');
            $post_image->move($destination, $featuredImageName);

            try{

                Invoice::whereId($id)->update([
                    'trf_image' => $featuredImageName,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                $json = [
                    'msg' => 'Bukti transfer berhasil ditambahkan',
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

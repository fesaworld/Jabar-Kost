<?php

namespace App\Http\Controllers;

use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Exception;

class UserProfileController extends Controller
{
    public function index()
    {

        $data = UserDetail::with('detailToUser')->where('user_id', Auth::user()->id)->first();
        // dd($data);

        $data = [
            'data' => $data,
            'script' => 'components.scripts.user.userProfile'
        ];

        return view('pages.user.userProfile', $data);
    }

    public function update(Request $request, $id)
    {
        //dd($request->file('userCard'), $request->all());

        $data = UserDetail::where('user_id', Auth::user()->id)->first();

        if($request->userAdd == NULL)
        {
            $json = [
                'msg'       => 'Mohon masukkan alamat anda',
                'status'    => false
            ];
        } else if($request->userPhone == NULL)
        {
            $json = [
                'msg'       => 'Mohon masukkan nomor telepon anda',
                'status'    => false
            ];
        } else if($request->userGender == NULL)
        {
            $json = [
                'msg'       => 'Mohon pilih jenis kelamin anda',
                'status'    => false
            ];
        } else {

            // buat profil
            if($request->file('userProfile'))
            {
                $profilImage = $request->file('userProfile');

                if($data->image)
                {
                    $pleaseRemove = base_path('public/assets/image/profil/').$data->image;

                    if(file_exists($pleaseRemove)) {
                        unlink($pleaseRemove);
                    }
                }

                $profilExtension  = $profilImage->getClientOriginalExtension();
                $featuredProfilName  = date('YmdHis').'.'.$profilExtension;
                $profilDestination = base_path('public/assets/image/profil/');
                $profilImage->move($profilDestination, $featuredProfilName);
            } else { $featuredProfilName = $data->image;}

            // buat idCard
            if($request->file('userCard'))
            {
                $cardImage = $request->file('userCard');

                if($data->card_id)
                {
                    $pleaseRemove = base_path('public/assets/image/idCard/').$data->image;

                    if(file_exists($pleaseRemove)) {
                        unlink($pleaseRemove);
                    }
                }

                $cardExtension  = $cardImage->getClientOriginalExtension();
                $featuredCardName  = date('YmdHis').'.'.$cardExtension;
                $cardDestination = base_path('public/assets/image/idCard/');
                $cardImage->move($cardDestination, $featuredCardName);
            } else { $featuredCardName = $data->card_id;}

            try{

                UserDetail::whereId($id)->update([
                    'address' => $request->userAdd,
                    'phone' => $request->userPhone,
                    'image' => $featuredProfilName,
                    'gender' => $request->userGender,
                    'card_id' => $featuredCardName,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                $json = [
                    'msg' => 'Data profil berhasil disunting',
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

<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDetail;
use App\ReferralCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Buat Register
    public function login(Request $request)
    {
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required|min:8'
        ];

        $messages = [
            'email.required'    => 'E-mail wajib diisi',
            'email.email'       => 'E-mail wajib nu baleg',
            'password.required' => 'Password wajib diisi',
            'password.min'      => 'Password minimal mengandung 8 karakter',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->email,
            'password'  => $request->password,
        ];

        if($request->has('remember')) {
            $remember = true;
        } else {
            $remember = false;
        }

        Auth::attempt($data, $remember);


        if(Auth::check()) {
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->withErrors(['error' => 'Email / Password salah'])->withInput($request->all);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->to('/');
    }

    public function viewLogin()
    {
        return view('form.login');
    }


    // Buat Register
    public function viewRegister()
    {
        return view('form.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'username'  => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:8',
            'token'     => 'required'
        ];

        $messages = [
            'username.required' => 'Username wajib diisi',
            'email.required'    => 'E-mail wajib diisi',
            'email.email'       => 'Format E-mail salah',
            'email.unique'      => 'E-mail sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min'      => 'Password minimal mengandung 8 karakter',
            'token.required'    => 'Kode referral wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $token = ReferralCode::where('token', $request->token)->where('status', 'Non-Aktif')->first();

        if($token)
        {

            $data   = [
                'name'      => $request->username,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'token'     => $request->token,
            ];
            $user = User::create($data);
            $user->syncRoles('User');

            UserDetail::create([
                'user_id' => $user->id,
                'ref_id' => $token->id,
                'address' => null,
                'phone' => null,
                'image' => null,
                'gender' => null,
                'card_id' => null,
                'status' => 'Non-Aktif',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            //buat update token
            $token -> update([
                'status' => 'Aktif'
            ]);

            // buat auth login
            $data = [
                'email'     => $request->email,
                'password'  => $request->password,
            ];

            Auth::attempt($data, $remember = true);

            if(Auth::check()) {
                return redirect()->to('/dashboard');
            }
        }

        return redirect()->back()->withErrors(['error' => 'Kode referral tidak ditemukan'])->withInput($request->all);
    }
}

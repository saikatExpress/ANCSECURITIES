<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function signUp()
    {
        return view('auth.signup');
    }

    public function store(Request $request)
    {
        return 1;
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name'                  => ['required'],
                'email'                 => ['required', 'email', 'unique:users'],
                'mobile'                => ['required'],
                'trading_code'          => ['required'],
                'password'              => ['required'],
                'password_confirmation' => ['required', 'same:password'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $userObj = new User();



            $name         = Str::title($request->input('name'));
            $email        = $request->input('email');
            $mobile       = $request->input('mobile');
            $trading_code = $request->input('trading_code');
            $password     = $request->input('password');

            $userObj->name = $name;
            $userObj->email = $email;
            $userObj->mobile = $mobile;
            $userObj->whatsapp = $mobile;
            $userObj->trading_code = $trading_code;
            $userObj->password = Hash::make($password);

            $res = $userObj->save();

            DB::commit();
            if($res){
                return response()->json(['success' => true]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }

    public function forgetPassword()
    {
        return view('auth.forgot');
    }
}

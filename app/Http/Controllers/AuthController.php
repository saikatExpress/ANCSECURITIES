<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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

            $userObj->name         = $name;
            $userObj->email        = $email;
            $userObj->mobile       = $mobile;
            $userObj->whatsapp     = $mobile;
            $userObj->trading_code = $trading_code;
            $userObj->password     = Hash::make($password);

            $res = $userObj->save();

            DB::commit();
            if($res){
                session()->flash('message', 'Registration successful! Please log in.');
                return response()->json(['success' => true]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function logStore(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'email'    => ['required', 'email'],
                'password' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $email    = $request->input('email');
            $password = $request->input('password');

            $user = User::where('email', $email)->first();

            if($user){
                if($user->status === 'deactive'){
                    return response()->json(['error' => 'This account is Deactive. If you want to activate your account, please contact with admin.']);
                }

                if($user->is_block == 1){
                    return response()->json(['error' => 'This account is blocked.']);
                }
            }

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $authUser = Auth::user();
                $request->session()->regenerate();
                $request->session()->put('user_id', $authUser->id);

                if ($user->role === 'user') {
                    $user->update(['otp' => null, 'user_agent' => $request->header('User-Agent'), 'last_login_at' => Carbon::now()]);
                    return response()->json(['success' => 'Login successful', 'redirect' => route('user.dashboard')]);
                } elseif ($user->role === 'admin') {
                    $user->update(['otp' => null, 'user_agent' => $request->header('User-Agent'), 'last_login_at' => Carbon::now()]);
                    return response()->json(['success' => 'Login successful', 'redirect' => route('admin.dashboard')]);
                } elseif ($user->role === 'executive') {
                    $user->update(['otp' => null, 'user_agent' => $request->header('User-Agent'), 'last_login_at' => Carbon::now()]);
                    return response()->json(['success' => 'Login successful', 'redirect' => route('executive.dashboard')]);
                }
            } else {
                return response()->json(['validationerror' => 'Email or password does not match.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return;
        }
    }

    public function forgetPassword()
    {
        return view('auth.forgot');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $url = md5('login');
        return redirect()->route($url);
    }
}

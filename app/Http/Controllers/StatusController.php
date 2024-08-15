<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StatusController extends Controller
{
    public function create()
    {
        $status = Session::get('status_session');

        if($status == ''){
            return abort(403);
        }

        if($status === 'deactive'){
            return view('auth.status');
        }

        return abort(403);
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'trading_code' => 'required|string',
        ]);

        $user = User::where('trading_code', $request->trading_code)->first();
        if ($user) {
            $otp = rand(100000, 999999);
            $expiresAt = now()->addMinutes(5);
            Session::forget('status_session');
            Session::put('otp', $otp);
            Session::put('otp_expires_at', $expiresAt);

            Mail::to($user->email)->send(new OTPMail($otp));
            $user->otp = $otp;
            $res = $user->save();
            if($res){
                return response()->json(['success' => 'OTP sent to your email']);
            }
        }

        return response()->json(['error' => 'Invalid trading code']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $otp = $request->input('otp');
        $user = User::where('otp', $otp)->first();
        $user->status = 'active';
        $user->save();
        if ($otp == Session::get('otp') && now()->lessThan(Session::get('otp_expires_at'))) {
            Session::forget(['otp', 'otp_expires_at']);
            return response()->json(['success' => 'OTP verified', 'redirect' => route('login')]);
        }

        return response()->json(['error' => 'Invalid or expired OTP']);
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\OTPMail;
use App\Models\BoAccount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
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

            $tradingCode = $request->input('trading_code');

            $tradingExit = BoAccount::where('bo_id', $tradingCode)->first();

            if(!$tradingExit){
                return response()->json(['error' => false, 'message' => 'Sorry... Tradecode not match...!']);
            }

            $inputName           = $request->input('name');
            $formattedInputName  = strtolower(str_replace(' ', '', $inputName));
            $formattedStoredName = strtolower(str_replace(' ', '', $tradingExit->name));
            $inputEmail          = $request->input('email');
            $inputMobile         = $request->input('mobile');

            if ($formattedInputName === $formattedStoredName && $tradingExit->email == $inputEmail && $tradingExit->cell_no == $inputMobile) {
                $otp = $this->generateOTP();

                Session::put('otp', $otp);

                Mail::to($request->input('email'))->send(new OTPMail($otp));

                $userObj = new User();

                $name        = Str::title($request->input('name'));
                $inputEmail = $request->input('email');
                $inputMobile = $request->input('mobile');
                $password    = $request->input('password');

                $userObj->name         = $name;
                $userObj->email        = $inputEmail;
                $userObj->mobile       = $inputMobile;
                $userObj->whatsapp     = $inputMobile;
                $userObj->otp          = $otp;
                $userObj->trading_code = $tradingCode;
                $userObj->password     = Hash::make($password);
                $userObj->status       = 'deactive';

                $res = $userObj->save();

                DB::commit();
                if($res){
                    session()->flash('message', 'Registration successful! Please log in.');

                    return response()->json(['success' => true]);
                }
            }else{
                return response()->json(['error' => false, 'message' => 'Email or mobile number does not match with trading code']);
            }


        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function checkOTP(Request $request)
    {
        $email = $request->query('email');
        $otp = $request->query('otp');

        if ($email && $otp) {
            if ($this->verifyOTP($email, $otp)) {
                return response()->json(['valid' => true, 'message' => 'OTP verified successfully']);
            } else {
                return response()->json(['valid' => false, 'message' => 'Invalid OTP']);
            }
        } else {
            return response()->json(['valid' => false, 'message' => 'Email or OTP not provided']);
        }
    }

    // Example function to verify OTP (replace with your actual verification logic)
    private function verifyOTP($email, $otp)
    {
        $user = User::where('email', $email)->first();

        $storedOTP = $user->otp;

        return $otp === $storedOTP;
    }

    public function otpStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp_confirmation' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $otp      = $request->input('otp_confirmation');
        $otpEmail = $request->input('otpEmail');

        $user = User::where('email', $otpEmail)->first();

        if($user){
            if($user->otp == $otp){
                $user->update(['status' => 'active']);
                session()->flash('message', 'Registration successful! Please log in.');

                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false, 'message' => 'An error occurred']);
    }

    public function getNameCheck(Request $request)
    {
        $name = $request->query('name');
        $tradingCode = $request->query('tradingCode');

        $clientInfo = BoAccount::where('bo_id', $tradingCode)->first();

        if ($clientInfo) {
            // Format both names for comparison
            $formattedInputName = strtolower(str_replace(' ', '', $name));
            $formattedStoredName = strtolower(str_replace(' ', '', $clientInfo->name));

            if ($formattedInputName === $formattedStoredName) {
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['error' => false]);
    }

    public function getEmailCheck(Request $request)
    {
        $email = $request->query('email');
        $tradingCode = $request->query('tradingCode');

        $clientInfo = BoAccount::where('bo_id', $tradingCode)->first();

        if ($clientInfo) {

            if ($clientInfo->email === $email) {
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['error' => false]);
    }

    public function getMobileCheck(Request $request)
    {
        $mobile = $request->query('mobile');
        $tradingCode = $request->query('tradingCode');

        $clientInfo = BoAccount::where('bo_id', $tradingCode)->first();

        if ($clientInfo) {

            if ($clientInfo->cell_no === $mobile) {
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['error' => false]);
    }


    private function generateOTP()
    {
        return str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }

    public function getTradeCode($code)
    {
        $tradeCode = BoAccount::where('bo_id', $code)->first();

        if($tradeCode){
            return response()->json(['success' => true, 'traderInfo' => $tradeCode]);
        }

        return response()->json(['error' => false]);
    }

    public function logStore(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validation
            $validator = Validator::make($request->all(), [
                'email'    => ['required', 'email'],
                'password' => ['required'],
            ]);

            if ($validator->fails()) {
                DB::rollBack();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $email    = $request->input('email');
            $password = $request->input('password');

            $user = User::where('email', $email)->first();

            if ($user) {
                if ($user->status === 'deactive') {
                    DB::rollBack();
                    return response()->json(['error' => 'This account is deactive. If you want to activate your account, please contact admin.']);
                }

                if ($user->is_block == 1) {
                    DB::rollBack();
                    return response()->json(['error' => 'This account is blocked.']);
                }
            } else {
                DB::rollBack();
                return response()->json(['validationerror' => 'Email or password does not match.']);
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $authUser = Auth::user();
                $request->session()->regenerate();
                $request->session()->put('user_id', $authUser->id);

                $user->otp           = null;
                $user->user_agent    = $request->header('User-Agent');
                $user->last_login_at = Carbon::now();
                $user->save();

                DB::commit();

                $redirectRoute = '';
                switch ($user->role) {
                    case 'user':
                        $redirectRoute = route('user.dashboard');
                        break;
                    case 'admin':
                        $redirectRoute = route('admin.dashboard');
                        break;
                    case 'executive':
                        $redirectRoute = route('executive.dashboard');
                        break;
                    default:
                        DB::rollBack();
                        return response()->json(['error' => 'Invalid user role.']);
                }

                return response()->json(['success' => 'Login successful', 'redirect' => $redirectRoute]);
            } else {
                DB::rollBack();
                return response()->json(['validationerror' => 'Email or password does not match.']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error during login process', ['exception' => $e]);
            return response()->json(['error' => 'An error occurred during the login process. Please try again later.']);
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
        return redirect()->to('/');
    }
}

<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use App\Models\BoAccount;
use App\Models\EmployeeWork;
use App\Mail\RegistrationSuccess;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public static function store($code,$name,$email,$fatherName,$motherName,$mobile,$whatsapp,$address,$bankName,$bankAccountNo,$branchName,$routingNumber,$password,$fileNameToStore, $signature,$checkBo, $role)
    {
        try {
            DB::beginTransaction();

            $userObj = new User();

            $userObj->name            = $name;
            $userObj->profile_image   = $fileNameToStore;
            $userObj->signature       = $signature;
            $userObj->father_name     = $fatherName;
            $userObj->spouse_name     = $fatherName;
            $userObj->mother_name     = $motherName;
            $userObj->email           = $email;
            $userObj->mobile          = $mobile;
            $userObj->whatsapp        = ($whatsapp) ?? $mobile;
            $userObj->address         = $address;
            $userObj->trading_code    = $code;
            $userObj->bank_name       = $bankName;
            $userObj->branch_name     = $branchName;
            $userObj->routing_number  = $routingNumber;
            $userObj->bank_account_no = $bankAccountNo;
            $userObj->role            = $role;
            $userObj->password        = Hash::make($password);
            $userObj->status          = 'active';
            $userObj->created_at      = Carbon::now();

            $res = $userObj->save();

            DB::commit();
            if($res){
                if($checkBo == 1){
                    $boAccountObj = new BoAccount();

                    $boAccountObj->bo_id           = $code;
                    $boAccountObj->name            = $name;
                    $boAccountObj->father_name     = $fatherName;
                    $boAccountObj->spouse_name     = $fatherName;
                    $boAccountObj->mother_name     = $motherName;
                    $boAccountObj->address         = $address;
                    $boAccountObj->cell_no         = $mobile;
                    $boAccountObj->email           = $email;
                    $boAccountObj->bank_account_no = $bankAccountNo;
                    $boAccountObj->bank_name       = $bankName;
                    $boAccountObj->branch_name     = $branchName;
                    $boAccountObj->trader_code     = 'ANCTRDR'.$code;
                    $boAccountObj->status          = '1';
                    $boAccountObj->created_at      = Carbon::now();

                    $res = $boAccountObj->save();
                    if($res){
                        $setting = Setting::first();
                        if($setting->registation_male === 1){
                            $user = [
                                'name'   => $name,
                                'mobile' => $mobile,
                            ];
                            Mail::to($email)->send(new RegistrationSuccess($user));
                        }
                        return true;
                    }
                }

                $setting = Setting::first();
                if($setting->registation_male === 1){
                    $user = [
                        'name'   => $name,
                        'mobile' => $mobile,
                    ];
                    Mail::to($email)->send(new RegistrationSuccess($user));
                }
                return true;
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

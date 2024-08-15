<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function create($boId,$name,$email,$fatherName,$spouseName,$motherName,$mobile,$address,$bankAcNo,$bankName,$branchName)
    {
        User::create([
            'name'            => $name,
            'profile_image'   => 'placeholder-profile.jpg',
            'father_name'     => $fatherName,
            'spouse_name'     => $spouseName,
            'mother_name'     => $motherName,
            'email'           => $email,
            'mobile'          => $mobile,
            'whatsapp'        => $mobile,
            'address'         => $address,
            'trading_code'    => $boId,
            'bank_name'       => $bankName,
            'branch_name'     => $branchName,
            'bank_account_no' => $bankAcNo,
            'role'            => 'user',
            'password'        => Hash::make('123456'),
            'status'          => 'deactive'
        ]);

        return true;
    }
}

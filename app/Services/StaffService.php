<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffService
{
    public function userCreate(string $name, $email, $mobile, string $role)
    {
        try {
            DB::beginTransaction();

            $userObj = new User;

            $userObj->name     = $name;
            $userObj->email    = $email;
            $userObj->mobile   = $mobile;
            $userObj->password = Hash::make('123456');
            $userObj->role     = $role;

            $res = $userObj->save();

            DB::commit();
            if($res){
                return true;
            }
        } catch (\Exception $e){
            DB::rollback();
            info($e);
        }
    }
}

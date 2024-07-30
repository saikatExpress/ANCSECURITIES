<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffService
{
    public function userCreate(string $name, $email, $mobile, string $role, $fileNameToStore)
    {
        try {
            DB::beginTransaction();

            $userObj = new User;

            $userObj->profile_image = $fileNameToStore;
            $userObj->name          = $name;
            $userObj->email         = $email;
            $userObj->mobile        = $mobile;
            $userObj->whatsapp      = $mobile;
            $userObj->password      = Hash::make('123456');
            $userObj->role          = $role;

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

    public function userUpdate(string $name, $email, $mobile, string $role, $fileNameToStore)
    {
        try {
            DB::beginTransaction();

            $user = User::where('email', $email)->first();

            $user->profile_image = $fileNameToStore;
            $user->name          = $name;
            $user->email         = $email;
            $user->mobile        = $mobile;
            $user->whatsapp      = $mobile;
            $user->password      = Hash::make('123456');
            $user->role          = $role;

            $res = $user->save();

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

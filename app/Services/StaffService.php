<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class StaffService
{
    public function userCreate(string $name, $email, $mobile, string $role, $fileNameToStore, $signature)
    {
        try {
            DB::beginTransaction();

            $userObj = new User;

            $userObj->profile_image = $fileNameToStore;
            $userObj->signature     = $signature;
            $userObj->name          = $name;
            $userObj->email         = $email;
            $userObj->mobile        = $mobile;
            $userObj->whatsapp      = $mobile;
            $userObj->password      = Hash::make('123456');
            $res = $userObj->save();

            if ($res) {
                $userObj->assignRole($role);
                DB::commit();
                return true;
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('User creation failed: ' . $e->getMessage());
            return false;
        }

        return false;
    }


    public function userUpdate(string $name, $email, $mobile, string $role, $fileNameToStore)
    {
        try {
            DB::beginTransaction();

            $user = User::where('email', $email)->first();

            if ($user) {
                $user->syncRoles([$role]);
            }

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
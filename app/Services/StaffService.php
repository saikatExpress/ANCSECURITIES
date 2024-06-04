<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffService
{
    public function userCreate($name, $email, $mobile,$branchSlug, $role)
    {
        try {
            DB::beginTransaction();

            $userObj = new User;

            $userObj->branch_slug = $branchSlug;
            $userObj->first_name  = $name;
            $userObj->email       = $email;
            $userObj->mobile      = $mobile;
            $userObj->password    = Hash::make('123456');
            $userObj->role        = $role;

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

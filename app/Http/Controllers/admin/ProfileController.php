<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function create()
    {
        return view('admin.profile.create');
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name'     => ['required'],
                'email'    => ['required'],
                'mobile'   => ['required'],
                'whatsapp' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $user = User::findOrFail(auth()->user()->id);
            if($user){
                $user->name     = $request->input('name');
                $user->email    = $request->input('email');
                $user->mobile   = $request->input('mobile');
                $user->whatsapp = $request->input('whatsapp');

                $res = $user->save();
                DB::commit();
                if($res){
                    $user->assignRole(auth()->user()->role);
                    return redirect()->back()->with('message', 'Profile information update successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Request update failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
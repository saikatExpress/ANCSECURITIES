<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        if(!in_array(auth()->user()->role, ['admin','Business Head'])){
            return redirect()->back()->with('error', 'You are not permitted for this..!');
        }

        $data['pageTitle'] = 'Update Project Setting';
        $data['setting'] = Setting::first();

        return view('admin.setting.create')->with($data);
    }

    public function modificationCreate()
    {
        $data['pageTitle'] = 'Create Modification';
        $data['investors'] = User::where('role', 'user')->get();
        $data['columns'] = Schema::getColumnListing('users');

        return view('admin.setting.modification.create')->with($data);
    }

    public function updateInformation(Request $request)
    {
        $data = $request->all();

        switch ($data['updateType']) {
            case 'name':
                $request->validate([
                    'prevName' => 'required|string',
                    'newName' => 'required|string',
                ]);
                // Update the user's name logic here
                break;

            case 'email':
                $request->validate([
                    'prevEmail' => 'required|email',
                    'newEmail' => 'required|email',
                ]);
                // Update the user's email logic here
                break;

            case 'trading_code':
                $request->validate([
                    'prevTradingCode' => 'required|string',
                    'newTradingCode' => 'required|string',
                ]);
                // Update the trading code logic here
                break;

            case 'bo_id':
                $request->validate([
                    'prevBoId' => 'required|string',
                    'newBoId' => 'required|string',
                ]);
                // Update the BO ID logic here
                break;

            case 'bank_account':
                $request->validate([
                    'prevBankAccount' => 'required|string',
                    'newBankAccount' => 'required|string',
                    'branchName' => 'required|string',
                    'bankName' => 'required|string',
                ]);
                // Update the bank account information logic here
                break;
        }

        // Assuming successful update
        return redirect()->back()->with('message', 'Information updated successfully!');
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'project_name' => ['required', 'string', 'max:250', 'min:10'],
                'project_email' => ['required', 'email'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $setting = Setting::first();

            if($setting){
                $setting->project_name = Str::title($request->input('project_name'));
                $setting->update_at = Carbon::now();

                $res = $setting->save();

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Setting update successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

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
        if(!in_array(auth()->user()->role, ['admin'])){
            return redirect()->back()->with('errorMsg', 'You are not permitted for this..!');
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
                'project_phone' => ['required'],
                'project_url' => ['required', 'url'],
                'body_background_color' => ['nullable', 'string', 'max:7'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $setting = Setting::first();

            DB::commit();

            if($setting){
                if ($request->hasFile('project_logo')) {
                    $projectLogoPath = $request->file('project_logo')->store('project_images', 'public');
                    $setting->project_logo = $projectLogoPath;
                }

                if ($request->hasFile('login_background_image')) {
                    $loginBackgroundImagePath = $request->file('login_background_image')->store('project_images', 'public');
                    $setting->login_background_image = $loginBackgroundImagePath;
                }

                if ($request->hasFile('signup_background_image')) {
                    $signupBackgroundImagePath = $request->file('signup_background_image')->store('project_images', 'public');
                    $setting->signup_background_image = $signupBackgroundImagePath;
                }


                $setting->project_name          = Str::title($request->input('project_name'));
                $setting->project_description   = $request->input('project_description');
                $setting->project_url           = $request->input('project_url');
                $setting->project_email         = $request->input('project_email');
                $setting->project_phone         = $request->input('project_phone');
                $setting->project_phone1        = $request->input('project_phone1');
                $setting->project_phone2        = $request->input('project_phone2');
                $setting->project_phone3        = $request->input('project_phone3');
                $setting->project_address       = $request->input('project_address');
                $setting->facebook_url          = $request->input('facebook_url');
                $setting->body_background_color = $request->input('body_background_color');
                $setting->twiter_url            = $request->input('twiter_url');
                $setting->instagram_url         = $request->input('instagram_url');
                $setting->whatsapp              = $request->input('whatsapp');
                $setting->sub_header            = $request->has('sub_header') ? 1 : 0;
                $setting->registration_status   = $request->has('registration_status') ? 1 : 0;
                $setting->otp_status            = $request->has('otp_status') ? 1 : 0;
                $setting->registation_male      = $request->has('registation_male') ? 1 : 0;
                $setting->deposite_male         = $request->has('deposite_male') ? 1 : 0;
                $setting->updated_at            = Carbon::now();

                $res = $setting->save();

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

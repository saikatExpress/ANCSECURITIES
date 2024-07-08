<?php

namespace App\Http\Controllers\admin;

use App\Models\DP;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DpController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'DP List';

        $data['dps'] = DP::all();

        return view('admin.DP.index')->with($data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Create DP';

        return view('admin.DP.create')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'dp_name'      => ['required'],
                'dp_email'     => ['required'],
                'phone_number' => ['required', 'min:11', 'max:20'],
                'address'      => ['required'],
                'website_link' => ['nullable','url'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }


            $dpObj = new DP();

            $dpObj->name                 = Str::title($request->input('dp_name'));
            $dpObj->slug                 = Str::slug($request->input('dp_name'), '-');
            $dpObj->email                = $request->input('dp_email');
            $dpObj->phone_number         = $request->input('phone_number');
            $dpObj->fax                  = $request->input('fax');
            $dpObj->address              = $request->input('address');
            $dpObj->employee_name        = $request->input('employee_name');
            $dpObj->employee_designation = $request->input('employee_designation');
            $dpObj->website_link         = $request->input('website_link');
            $dpObj->status               = $request->input('status');

            $res = $dpObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'DP create successfully..!');
            return 'Saikat';

            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

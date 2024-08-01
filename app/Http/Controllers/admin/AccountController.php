<?php

namespace App\Http\Controllers\admin;

use App\Models\Account;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index(Request $request)
    {
        $data['pageTitle'] = 'Account List';
        $data['accounts'] = Account::all();

        return view('admin.account.index')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name'           => 'required|string|max:255',
                'balance'        => 'required|numeric',
                'account_number' => 'required|string|max:255|unique:accounts',
                'bank_name'      => 'nullable|string|max:255',
                'branch_name'    => 'nullable|string|max:255',
                'ifsc_code'      => 'nullable|string|max:255',
                'account_type'   => 'nullable|string|in:savings,current,fixed_deposit,recurring_deposit,loan,nre,nro',
            ]);

            $accountObj                  = new Account();
            $accountObj->name            = Str::title($request->name);
            $accountObj->slug            = Str::slug($request->name, '-');
            $accountObj->initial_balance = $request->balance;
            $accountObj->balance         = $request->balance;
            $accountObj->costing_balance = $request->balance;
            $accountObj->account_number  = $request->account_number;
            $accountObj->bank_name       = $request->bank_name;
            $accountObj->branch_name     = $request->branch_name;
            $accountObj->ifsc_code       = $request->ifsc_code;
            $accountObj->account_type    = $request->account_type;

            $res = $accountObj->save();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Account created successfully'], 200);
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);

            Log::error('Staff creation failed: '.$e->getMessage());

            return response()->json(['error' => 'Failed to create account'], 500);
        }
    }
}

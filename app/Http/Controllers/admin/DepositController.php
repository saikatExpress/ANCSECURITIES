<?php

namespace App\Http\Controllers\admin;

use App\Models\Fund;
use Illuminate\Http\Request;
use App\Services\FundService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DepositController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function create()
    {
        $data['pageTitle'] = 'Create Deposite';

        $data['deposits'] = Fund::with('clients')->where('category', 'deposit')->latest()->get();

        return view('admin.request.deposit.create')->with($data);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'trading_code'  => ['required'],
            'name'          => ['required'],
            'amount'        => ['required'],
            'bank_account'  => ['required'],
            'deposite_date' => ['required'],
            'bank_slip'     => ['required', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2024'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $fundServiceObj = new FundService();

        $category    = 'deposit';
        $clientId    = $request->input('client_id');
        $code        = $request->input('trading_code');
        $name        = $request->input('name');
        $mobile      = $request->input('mobile');
        $amount      = $request->input('amount');
        $bankAccount = $request->input('bank_account');
        $date        = $request->input('deposite_date');

        if ($request->hasFile('bank_slip')) {
            $file = $request->file('bank_slip');
            $path = $file->store('bank_slips', 'public');
        }

        $res = $fundServiceObj->depostore($clientId,$code,$name,$mobile,$amount,$bankAccount,$date,$category, $path);

        if($res === true){
            return redirect()->back()->with('message', 'Deposit request submitted successfully');
        }
    }
}

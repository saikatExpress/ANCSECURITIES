<?php

namespace App\Http\Controllers\admin;

use App\Models\Fund;
use Illuminate\Http\Request;
use App\Services\FundService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $sessionId = Session::get('user_id');
        if(!$sessionId){
            return route('login');
        }
    }

    public function create()
    {
        $data['pageTitle'] = 'Create Withdraw';

        $query = Fund::with('clients:id,name,trading_code')
            ->where('category', 'withdraw')
            ->where('status', 'pending')
            ->latest()
            ->take(20);

        if (auth()->user()->role === 'ceo') {
            $query->whereNotNull('ceo');
        } elseif (auth()->user()->role === 'md') {
            $query->whereNotNull('md');
        }

        $data['withdraws'] = $query->get();

        if (auth()->user()->role === 'ceo' || auth()->user()->role === 'md') {
            return view('admin.Request.auth.index')->with($data);
        }

        return view('admin.Request.wcreate')->with($data);

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'trading_code'  => ['required'],
            'name'          => ['required'],
            'amount'        => ['required'],
            'bank_account'  => ['required'],
            'withdraw_date' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $fundServiceObj = new FundService();

        $category    = 'withdraw';
        $clientId    = $request->input('client_id');
        $name        = $request->input('name');
        $amount      = $request->input('amount');
        $bankAccount = $request->input('bank_account');
        $date        = $request->input('withdraw_date');

        $res = $fundServiceObj->store($clientId,$name,$amount,$bankAccount,$date,$category);

        if($res === true){
            return redirect()->back()->with('message', 'Withdraw request replacement successfully');
        }
    }
}

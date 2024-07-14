<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\User;
use App\Models\BoAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\FundRepositoryInterface;

class PaymentController extends Controller
{
    protected $fundRepository;

    public function __construct(FundRepositoryInterface $fundRepository)
    {
        $this->middleware('auth');

        $this->fundRepository = $fundRepository;
    }

    public function fundWithdrawCreate()
    {
        $data['funds'] = Fund::where('client_id', Auth::id())->latest()->get();

        return view('user.fund.withdraw')->with($data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'amount'        => 'required|numeric',
            'bank_account'  => 'required|string',
            'withdraw_date' => 'required|date',
            'description'   => 'nullable|string',
        ]);

        $fundData = [
            'client_id'     => Auth::id(),
            'client_name'   => auth()->user()->name,
            'amount'        => $data['amount'],
            'ac_no'         => $data['bank_account'],
            'withdraw_date' => $data['withdraw_date'],
            'description'   => $data['description'],
            'category'      => 'withdraw',
        ];

        $clientInfo = User::find(Auth::id());

        $accountInfo = BoAccount::where('bo_id', $clientInfo->trading_code)->first();

        if($accountInfo->bank_account_no !== $request->input('bank_account')){
            return redirect()->back()->with('error', 'Your account number is invalid.Please enter valid account number');
        }

        $this->fundRepository->create($fundData);

        return redirect()->back()->with('success', 'Fund request created successfully.');
    }

    public function depositeStore(Request $request)
    {
        $data = $request->validate([
            'amount'        => 'required|numeric',
            'bank_account'  => 'required|string',
            'withdraw_date' => 'required|date',
            'description'   => 'nullable|string',
        ]);
    }

    public function depositeMoney()
    {
        return view('user.fund.deposite');
    }
}

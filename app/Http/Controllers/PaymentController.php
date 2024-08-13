<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use App\Models\User;
use App\Models\BoAccount;
use App\Models\LimitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $data['funds'] = Fund::where('client_id', Auth::id())->where('category', 'withdraw')->latest()->get();

        return view('user.fund.withdraw')->with($data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'amount'        => 'required|numeric',
            'withdraw_date' => 'required|date',
            'description'   => 'nullable|string',
        ]);

        $fundData = [
            'client_id'     => Auth::id(),
            'client_name'   => auth()->user()->name,
            'amount'        => $data['amount'],
            'ac_no'         => auth()->user()->bank_account_no,
            'withdraw_date' => $data['withdraw_date'],
            'description'   => $data['description'],
            'category'      => 'withdraw',
        ];

        $this->fundRepository->create($fundData);

        return redirect()->back()->with('success', 'Fund request created successfully.');
    }

    public function depositeStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'amount'        => 'required|numeric',
                'bank_account'  => 'required|string|max:100',
                'bank_slip'     => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
                'deposit_date'  => 'required|date',
                'description'   => 'nullable|string|max:500',
            ]);

            $clientInfo = User::find(Auth::id());

            $accountInfo = BoAccount::where('bo_id', $clientInfo->trading_code)->first();

            if($accountInfo->bank_account_no !== $request->input('bank_account')){
                return redirect()->back()->with('error', 'Your account number is invalid.Please enter valid account number');
            }

            $fundObj = new Fund();

            if ($request->hasFile('bank_slip')) {
                $file                       = $request->file('bank_slip');
                $path                       = $file->store('bank_slips', 'public');
                $validatedData['bank_slip'] = $path;
            } else {
                $path = null;
            }

            $fundObj->client_id     = Auth::id();
            $fundObj->client_name   = auth()->user()->name;
            $fundObj->amount        = $validatedData['amount'];
            $fundObj->ac_no         = $validatedData['bank_account'];
            $fundObj->category      = 'deposit';
            $fundObj->bank_slip     = $validatedData['bank_slip'];
            $fundObj->withdraw_date = $validatedData['deposit_date'];
            $fundObj->description   = $validatedData['description'];

            $res = $fundObj->save();

            DB::commit();

            if($res) {
                return redirect()->back()->with('success', 'Fund deposit created successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to create fund deposit.');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return redirect()->back()->with('error', 'An error occurred while creating the fund deposit.');
        }
    }

    public function requestCreate()
    {
        $requests = LimitRequest::where('client_id', Auth::id())->latest()->get();

        return view('user.limit.create', compact('requests'));
    }

    public function requestStore(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'client_id'        => 'required|string|max:255',
            'client_name'      => 'required|string|max:255',
            'requested_limit'  => 'required|numeric',
            'reason'           => 'required|string|max:500',
        ]);

        // If validation fails, return back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Create a new instance of your model and save the data
            $limitRequest = new LimitRequest();

            $limitRequest->client_id    = Auth::id();
            $limitRequest->trade_id     = $request->input('client_id');
            $limitRequest->client_name  = ($request->input('client_name')) ?? auth()->user()->name;
            $limitRequest->limit_amount = $request->input('requested_limit');
            $limitRequest->reason       = $request->input('reason');

            $limitRequest->save();

            DB::commit();

            return redirect()->back()->with('success', 'Trade limit request submitted successfully.');

        } catch (\Throwable $th) {
            DB::rollback();
            // Log the error or handle it as needed
            return redirect()->back()->with('error', 'Failed to submit trade limit request. Please try again.');
        }
    }

    public function depositeMoney()
    {
        $depositeHistory = Fund::where('client_id', Auth::id())->where('category', 'deposit')->latest()->get();

        return view('user.fund.deposite', compact('depositeHistory'));
    }
}

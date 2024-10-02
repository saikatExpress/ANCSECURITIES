<?php

namespace App\Http\Controllers\admin;

use App\Models\Fund;
use App\Models\Staff;
use App\Models\RequestFile;
use Illuminate\Http\Request;
use App\Services\FundService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\BoAccount;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $sessionId = Session::get('user_id');
        if(!$sessionId){
            return route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = "Withdraw Request Title";

        $groupedData = RequestFile::select('created_by', DB::raw('count(*) as total'))
            ->groupBy('created_by')
            ->get();

        $requestFiles = RequestFile::with('funds')->get();

        $data['combinedData'] = $groupedData->map(function ($group) use ($requestFiles) {
            return [
                'created_by' => $group->created_by,
                'total' => $group->total,
                'details' => $requestFiles->filter(function ($requestFile) use ($group) {
                    return $requestFile->created_by == $group->created_by;
                })
            ];
        });

        return view('admin.Request.withdraw.index', compact('groupedData'))->with($data);
    }

    public function withdrawIndex()
    {
        $pageTitle = 'Client Fund withdraw Request';

        $limitRequests = Fund::with('clients:id,name,email,trading_code,mobile,whatsapp')->where('category', 'withdraw')->get();

        return view('admin.Request.withdraw', compact('pageTitle','limitRequests'));
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
            $query->whereNotNull('ceo')->where('flag', 1);
        } elseif (auth()->user()->role === 'md') {
            $query->where('mdstatus', 'assign')->whereNotNull('md');
        }

        $data['withdraws'] = $query->get();

        if (auth()->user()->role === 'ceo' || auth()->user()->role === 'md') {
            return view('admin.Request.auth.index')->with($data);
        }

        return view('admin.Request.wcreate')->with($data);
    }

    public function fetchRequestInfo($id)
    {
        $request = Fund::with('clients')->where('id', $id)->first();
        $account = BoAccount::where('bank_account_no', $request->ac_no)->first();

        return view('admin.request.partials.create', compact('request', 'account'))->render();
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['account', 'admin', 'hr'])) {
            return redirect()->back()->with('error', 'This action is not permitted for you.');
        }

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

    public function show($id)
    {
        $data['pageTitle'] = 'Show Withdraw Form';
        $data['withdraw'] = Fund::with('clients:id,name,mobile,trading_code,status')->where('id',$id)->where('category', 'withdraw')->first();

        $data['staff'] = Staff::find($data['withdraw']->approved_by);

        return view('admin.Request.show')->with($data);
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'reqId'  => ['required'],
                'amount' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $reqId = $request->input('reqId');

            $withdraw = Fund::findOrFail($reqId);

            $withdraw->amount = $request->input('amount');
            $res = $withdraw->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Withdraw update successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}
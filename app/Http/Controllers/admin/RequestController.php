<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Fund;
use App\Models\User;
use App\Models\BoAccount;
use App\Models\LimitRequest;
use Illuminate\Http\Request;
use App\Services\FundService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $pageTitle = 'All Request';

        $limitRequests = LimitRequest::with('clients:id,name,email,trading_code,mobile,whatsapp')->get();

        return view('admin.Request.index', compact('pageTitle','limitRequests'));
    }

    public function manuelRequest()
    {
        $pageTitle = 'Manual Request';

        return view('admin.Request.manual', compact('pageTitle'));
    }

    public function getClientInfo($code)
    {
        $tradeCode = BoAccount::where('bo_id', $code)->first();

        $exitsUser = User::where('trading_code', $code)->where('role', 'user')->first();

        if($exitsUser){
            return response()->json(['tradeInfo' => $tradeCode, 'user' => $exitsUser]);
        }

    }

    public function limitIndex()
    {
        $pageTitle = 'Today Limit Request';

        $limitRequests = LimitRequest::with('clients:id,name,email,trading_code,mobile,whatsapp')->whereDate('created_at', Carbon::now())->get();

        return view('admin.Request.today', compact('pageTitle','limitRequests'));
    }

    public function declineIndex()
    {
        $pageTitle = 'Declined Limit Request';

        $limitRequests = LimitRequest::with('clients:id,name,email,trading_code,mobile,whatsapp')->where('status', 'canceled')->get();

        return view('admin.Request.declined', compact('pageTitle','limitRequests'));
    }

    public function manualStore(Request $request)
    {
        try {
            DB::beginTransaction();

            $requestType = $request->input('request');
            $clientId    = $request->input('client_id');
            $code        = $request->input('trading_code');
            $name        = $request->input('name');
            $email       = $request->input('email');
            $mobile      = $request->input('mobile');
            $amount      = $request->input('amount');
            $bankAccount = $request->input('bank_account');
            $date = $request->input('date');

            DB::commit();

            if ($request->hasFile('bank_slip')) {
                $file                       = $request->file('bank_slip');
                $path                       = $file->store('bank_slips', 'public');
            } else {
                $path = null;
            }

            if($requestType === 'limit'){
                LimitRequest::createData($clientId,$code,$name, $email, $mobile, $amount);
                return redirect()->back()->with('message', $requestType.' request saved successfully');
            }elseif($requestType === 'withdraw'){
                Fund::createData($requestType,$clientId,$code,$name, $email, $mobile, $amount, $bankAccount, $date, $path);
                return redirect()->back()->with('message', $requestType.' request saved successfully');
            }elseif($requestType === 'deposite'){
                Fund::createData($requestType,$clientId,$code,$name, $email, $mobile, $amount, $bankAccount, $date, $path);
                return redirect()->back()->with('message', $requestType.' request saved successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return false;
        }
    }

    public function withdrawIndex()
    {
        $pageTitle = 'Client Fund withdraw Request';

        $limitRequests = Fund::with('clients:id,name,email,trading_code,mobile,whatsapp')->where('category', 'withdraw')->get();

        return view('admin.Request.withdraw', compact('pageTitle','limitRequests'));
    }

    public function depositIndex()
    {
        $pageTitle = 'Client Fund Deposit Request';

        $limitRequests = Fund::with('clients:id,name,email,trading_code,mobile,whatsapp')->where('category', 'deposit')->get();

        return view('admin.Request.deposit', compact('pageTitle','limitRequests'));
    }

    public function toggleStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,canceled',
        ]);

        $limitRequest = LimitRequest::findOrFail($id);

        $user = auth()->user();

        if ($request->status === 'approved') {
            $limitRequest->update([
                'status' => 'approved',
                'approved_by' => $user->name,
                'declined_by' => null,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $limitRequest->update([
                'status' => 'canceled',
                'approved_by' => null,
                'declined_by' => $user->name,
                'updated_at' => Carbon::now(),
            ]);
        }

        return response()->json(['message' => 'Status updated successfully.', 'status' => $limitRequest->status]);
    }

    public function requestWithdraw(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,canceled',
        ]);

        $fund = Fund::findOrFail($id);

        $user = auth()->user();

        if ($request->status === 'approved') {
            // Update 'approved_by' column
            $fund->update([
                'status' => 'approved',
                'approved_by' => $user->id,
                'declined_by' => NULL,
            ]);
        } elseif ($request->status === 'canceled') {
            $fund->update([
                'status' => 'canceled',
                'declined_by' => $user->id,
                'approved_by' => NULL,
            ]);
        }

        return response()->json(['message' => 'Request status updated successfully']);
    }

    public function withdrawStore(Request $request)
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
        $clientId        = $request->input('client_id');
        $code        = $request->input('trading_code');
        $name        = $request->input('name');
        $mobile      = $request->input('mobile');
        $amount      = $request->input('amount');
        $bankAccount = $request->input('bank_account');
        $date        = $request->input('withdraw_date');

        $res = $fundServiceObj->store($clientId,$code,$name,$mobile,$amount,$bankAccount,$date,$category);

        if($res === true){
            return redirect()->back()->with('message', 'Withdraw request replacement successfully');
        }
    }

    public function depositeStore(Request $request)
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

        $category    = 'deposite';
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
            return redirect()->back()->with('message', 'Deposite request submitted successfully');
        }
    }

    public function fetchLimitRequest()
    {
        $requests = LimitRequest::with('clients:id,name,email,trading_code')->where('status', 'pending')->get();

        return response()->json($requests);
    }

    public function updateLimitRequest($id)
    {
        $limitRequest = LimitRequest::find($id);

        if($limitRequest){
            $limitRequest->status      = 'approved';
            $limitRequest->approved_by = auth()->user()->name;
            $limitRequest->declined_by = null;
            $limitRequest->updated_at  = Carbon::now();

            $limitRequest->save();

            return response()->json(['success' => true]);
        }
    }

    public function declineLimitRequest($id)
    {
        $limitRequest = LimitRequest::find($id);

        if($limitRequest){
            $limitRequest->status      = 'canceled';
            $limitRequest->approved_by = null;
            $limitRequest->declined_by = auth()->user()->name;
            $limitRequest->updated_at  = Carbon::now();

            $limitRequest->save();

            return response()->json(['success' => true]);
        }
    }

    public function requestDeposit(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,canceled',
        ]);

        $fund = Fund::findOrFail($id);

        $user = auth()->user();

        if ($request->status === 'approved') {
            // Update 'approved_by' column
            $fund->update([
                'status' => 'approved',
                'approved_by' => $user->id,
                'declined_by' => NULL,
            ]);
        } elseif ($request->status === 'canceled') {
            $fund->update([
                'status' => 'canceled',
                'declined_by' => $user->id,
                'approved_by' => NULL,
            ]);
        }

        return response()->json(['message' => 'Request status updated successfully']);
    }

    public function fetchRequests(Request $request)
    {
        $type = $request->query('type');

        // Validate the type if needed

        // Fetch data based on type
        if ($type === 'withdraw') {
            $requests = Fund::with('clients')
                ->where('category', 'withdraw')
                ->where('status', 'pending')
                ->orderByDesc('id')
                ->get();
        } elseif ($type === 'deposit') {
            $requests = Fund::with('clients')
                ->where('category', 'deposit')
                ->where('status', 'pending')
                ->orderByDesc('id')
                ->get();
        } else {
            // Handle invalid type if needed
            $requests = [];
        }

        // Return JSON response
        return response()->json($requests);
    }

    public function limitDestroy($id)
    {
        try {
            DB::beginTransaction();

            $request = LimitRequest::find($id);

            if (!$request) {
                return response()->json(['message' => 'Limit Request not found.'], 404);
            }

            $res = $request->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Limit Request deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

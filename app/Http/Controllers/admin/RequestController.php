<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Fund;
use App\Models\User;
use App\Models\Staff;
use App\Models\BoAccount;
use App\Models\RequestFile;
use Illuminate\Support\Str;
use App\Models\LimitRequest;
use Illuminate\Http\Request;
use App\Services\FundService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function create()
    {
        if (!in_array(auth()->user()->role, ['it', 'admin', 'account', 'hr'])) {
            return redirect()->back()->with('errorMsg', 'You are not permitted for this..!');
        }

        $data['pageTitle'] = 'Create Limit';
        $data['limitRequest'] = LimitRequest::with('clients:id,name')->whereDate('created_at', Carbon::today())->latest()->take(20)->get();

        return view('admin.Request.create')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'trading_code' => ['required'],
                'name'         => ['required'],
                'mobile'       => ['required'],
                'amount'       => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $limitObj = new LimitRequest();

            $limitObj->client_id    = $request->input('client_id');
            $limitObj->trade_id     = $request->input('trading_code');
            $limitObj->client_name  = $request->input('name');
            $limitObj->limit_amount = $request->input('amount');
            $limitObj->reason       = Str::title('Trade for Limit');
            $limitObj->approved_by  = Str::title(auth()->user()->name);
            $limitObj->status       = 'approved';
            $limitObj->created_at   = Carbon::now();

            $res = $limitObj->save();

            DB::commit();
            if($res){
                return redirect()->back()->with('message', 'Limit created successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            Log::error('Staff creation failed: '.$e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function updateReqStatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'status' => ['required'],
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $withdraw = Fund::find($request->input('req_id'));
            if (!$withdraw) {
                return redirect()->back()->with('errors', 'Request not found');
            }

            $status = $request->input('status');
            $userRole = auth()->user()->role;

            if ($userRole === 'md') {
                $this->handleMDApproval($withdraw, $status);
            } else {
                $this->handleCEOApproval($withdraw, $status);
            }

            DB::commit();
            $res = $withdraw->save();
            if($res){
                return redirect()->back()->with('message', 'Update successful and sent to Managing Director for approval.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            Log::error('Request creation failed: '.$e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    private function handleMDApproval($withdraw, $status)
    {
        if ($status === 'approved') {
            $withdraw->ceostatus = $status;
            $withdraw->mdstatus = $status;
            $withdraw->remark = $this->formatRemark('successfully approved by managing director');
        } elseif ($status === 'deny') {
            $this->declineRequest($withdraw);
            RequestFile::where('request_id', $withdraw->id)->delete();
        }
    }

    private function handleCEOApproval($withdraw, $status)
    {
        $md = User::where('role', 'md')->where('status', 'active')->first();
        if (!$md) {
            throw new \Exception('Managing Director account not found');
        }

        if ($status === 'approved') {
            $withdraw->ceostatus = $status;
            $withdraw->mdstatus = 'assign';
            $withdraw->md = $md->name;
            $withdraw->remark = $this->formatRemark('handover to the managing director');
        } elseif ($status === 'deny') {
            $this->declineRequest($withdraw);
            RequestFile::where('request_id', $withdraw->id)->delete();
        }
    }

    private function declineRequest($withdraw)
    {
        $withdraw->ceo = null;
        $withdraw->ceostatus = 'decline';
        $withdraw->mdstatus = null;
        $withdraw->md = null;
        $withdraw->approved_by = null;
        $withdraw->flag = 0;
        $withdraw->remark = $this->formatRemark('declined this request');
    }

    private function formatRemark($message)
    {
        return $message . ' by ' . auth()->user()->name . ' at ' . formatDateTime(now());
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'trading_code' => ['required'],
                'name'         => ['required'],
                'amount'       => ['required'],
                'status'       => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $requestId = $request->input('req_id');
            $clientId = $request->input('client_id');

            $limit = LimitRequest::where('id', $requestId)->first();

            if($limit){
                $limit->client_id    = $clientId;
                $limit->trade_id     = $request->input('trading_code');
                $limit->client_name  = $request->input('name');
                $limit->limit_amount = $request->input('amount');
                $limit->reason       = Str::title('Trade for Limit');
                $limit->approved_by  = Str::title(auth()->user()->name);
                $limit->status       = $request->input('status');
                $limit->updated_at   = Carbon::now();

                $res = $limit->save();

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'Limit updated successfully');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            Log::error('Staff creation failed: '.$e->getMessage());

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
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
            }elseif($requestType === 'deposit'){
                Fund::createData($requestType,$clientId,$code,$name, $email, $mobile, $amount, $bankAccount, $date, $path);
                return redirect()->back()->with('message', $requestType.' request saved successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return false;
        }
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
            $requests = [];
        }

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
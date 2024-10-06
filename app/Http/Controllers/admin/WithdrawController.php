<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Fund;
use App\Models\User;
use App\Models\Staff;
use App\Models\BoAccount;
use App\Models\RequestFile;
use Illuminate\Http\Request;
use App\Services\FundService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\ActivityService;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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

        $data['withdrawlist'] = Fund::with('clients:id,name,email,trading_code,mobile,whatsapp')->where('category', 'withdraw')->get();

        return view('admin.Request.withdraw.index')->with($data);
    }

    public function deletedRequest()
    {
        $data['pageTitle'] = "Withdraw Request";
        $data['deletedRequest'] = Fund::onlyTrashed()->where('category', 'withdraw')->get();

        return view('admin.request.withdraw.delete')->with($data);
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

    public function requestWithdraw(Request $request, $id)
    {
        if(!in_array(auth()->user()->role, ['ceo','admin', 'Business Head', 'md'])){
            return response()->json(['error' => false, 'message' => 'This action is unathorized.Please contact with admin.']);
        }

        $request->validate([
            'status' => 'required|in:approved,canceled',
        ]);

        $fund = Fund::findOrFail($id);
        if($fund->ceostatus === 'approved' || $fund->mdstatus === 'approved'){
            return response()->json(['error' => false, 'message' => 'This request already approved.']);
        }
        $user = auth()->user();

        if ($request->status === 'approved') {
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

        return response()->json(['success' => true,'message' => 'Request status updated successfully']);
    }

    public function fetchRequestInfo($id)
    {
        $request = Fund::with('clients')->where('id', $id)->first();
        $account = BoAccount::where('bank_account_no', $request->ac_no)->first();

        return view('admin.request.partials.create', compact('request', 'account'))->render();
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
            $activityServiceObj = new ActivityService();
            $activityServiceObj->withdrawActivityService();
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

    public function withdrawStatus($id)
    {
        $request = Fund::where('category', 'withdraw')->where('id', $id)->first();

        if($request){
            return response()->json($request);
        }
    }

    public function upgradeWithdrawStatus(Request $request)
    {
        $request->validate([
            'id'     => 'required|integer|exists:funds,id',
            'status' => 'required|in:accept,deny',
        ]);

        $requestId = $request->input('id');
        $status    = $request->input('status');

        $fundServiceObj = new FundService();
        $result = $fundServiceObj->updateWithdrawStatus($requestId,$status);
        if($result === 'approved'){
            return response()->json(['error' => false, 'message' => 'This request has already approved by CEO or MD.']);
        }

        if($result === true){
            return response()->json(['success' => true, 'message' => 'Withdraw request status updated successfully.']);
        }
        return response()->json(['error' => false, 'message' => 'Withdraw request not found.']);
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $reqeust = Fund::where('id',$id)->where('category', 'withdraw')->first();
            if($reqeust->ceostatus === 'approved' && $reqeust->mdstatus === 'approved'){
                return response()->json(['error' => false,'message' => 'This request has already approved by CEO & MD.'], 404);
            }
            if (!$reqeust) {
                return response()->json(['message' => 'Reqeust not found.'], 404);
            }

            $portfolioFile = $reqeust->portfolio_file;
            if ($portfolioFile && Storage::disk('public')->exists($portfolioFile)) {
                Storage::disk('public')->delete($portfolioFile);
            }

            $requestFile = RequestFile::where('request_id', $id)->first();
            if($requestFile){
                $requestFile->delete();
            }

            $res = $reqeust->delete();

            if ($res) {
                DB::commit();
                return response()->json(['success' => true,'message' => 'Withdraw request deleted successfully.']);
            } else {
                DB::rollback();
                return response()->json(['message' => 'Failed to delete the Withdraw request.'], 500);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return response()->json(['message' => 'An error occurred.'], 500);
        }
    }
}
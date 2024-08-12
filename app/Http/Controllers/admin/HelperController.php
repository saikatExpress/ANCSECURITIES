<?php

namespace App\Http\Controllers\admin;

use App\Models\Fund;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function updateReqStatus($id)
    {
        $role = auth()->user()->role;
        $withdraw = Fund::findOrFail($id);

        if($withdraw){
            if($role === 'ceo'){
                $withdraw->ceo = auth()->user()->name;
                $withdraw->ceostatus = 'decline';
                $withdraw->md = NULL;
                $withdraw->mdstatus = NULL;

                $withdraw->save();

                return response()->json(['success' => true, 'message' => 'Request has been decline']);
            }

            $withdraw->md = auth()->user()->name;
            $withdraw->mdstatus = 'decline';

            $withdraw->save();

            return response()->json(['success' => true, 'message' => 'Request has been decline']);
        }
    }

    public function acceptReqStatus(Request $request, $id)
    {
        $role = auth()->user()->role;
        $status = $request->input('status');

        $withdraw = Fund::findOrFail($id);

        if($withdraw){
            if($role === 'md'){
                $withdraw->md = auth()->user()->name;
                $withdraw->mdstatus = $status;

                $withdraw->save();

                return response()->json(['success' => true, 'message' => 'Request has been ' . $status]);
            }

            if($role === 'ceo'){
                $md = User::where('role', 'md')->where('status', 'active')->first();
                if(!$md){
                    return response()->json(['error' => true, 'message' => 'Manager Director account not found']);
                }

                $withdraw->ceostatus = $request->input('status');
                $withdraw->mdstatus  = $request->input('status');
                $withdraw->md        = $md->name;

                $withdraw->save();

                return response()->json(['success' => true, 'message' => 'Request has been ' . $status]);
            }
        }
    }

    public function getWithdrawInfo($id)
    {
        $withDraw = Fund::with('clients:id,name,email,mobile,trading_code')->where('id', $id)->where('category', 'withdraw')->get();

        return response()->json($withDraw);
    }

    public function uploadPortfolio(Request $request)
    {
        // Validate the request
        $request->validate([
            'reqId' => 'required|integer',
            'portfolio_file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);

        if ($request->hasFile('portfolio_file')) {
            $file = $request->file('portfolio_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('withdrawportfolios', $fileName, 'public');

            $reqId = $request->input('reqId');

            $withdraw = Fund::find($reqId);

            if($withdraw){
                $withdraw->portfolio_file = $filePath;

                $withdraw->save();
            }
        }

        return redirect()->back()->with('message', 'File uploaded successfully.');
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
            'id' => 'required|integer|exists:funds,id',
            'status' => 'required|in:accept,deny',
        ]);

        $requestId = $request->input('id');
        $status    = $request->input('status');

        $withdrawRequest = Fund::where('id', $requestId)->first();
        $ceo = User::where('role', 'ceo')->where('status', 'active')->first();

        if (!$withdrawRequest) {
            return response()->json(['message' => 'Withdraw request not found.'], 404);
        }

        if ($status === 'accept') {
            $withdrawRequest->approved_by = auth()->user()->id;
            $withdrawRequest->declined_by = null;
            $withdrawRequest->ceo = $ceo->name;
        } elseif ($status === 'deny') {
            $withdrawRequest->declined_by = auth()->user()->id;
            $withdrawRequest->approved_by = null;
            $withdrawRequest->ceo = null;
        }

        $withdrawRequest->save();

        return response()->json(['message' => 'Withdraw request status updated successfully.']);
    }
}

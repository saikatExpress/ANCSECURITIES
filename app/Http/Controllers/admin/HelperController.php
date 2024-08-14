<?php

namespace App\Http\Controllers\admin;

use App\Models\Fund;
use App\Models\User;
use App\Models\Staff;
use App\Models\BoAccount;
use App\Models\RequestFile;
use Barryvdh\DomPDF\PDF;
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

    public function createFile(Request $request)
    {
        $ids = $request->input('ids');

        if (is_array($ids)) {
            $exists = RequestFile::whereIn('request_id', $ids)->get();
            if ($exists->isNotEmpty()) {
                return response()->json(['success' => false]);
            } else {
                // No records found
            }
        }else{
            $exists = RequestFile::where('request_id', $ids)->first();
            if($exists){
                return 'false';
            }
        }

        foreach($ids as $id){
            $fileObj = new RequestFile();

            $fileObj->request_id = $id;
            $fileObj->created_by = auth()->user()->id;
            $fileObj->category = 'withdraw';
            $fileObj->save();
        }


        return response()->json(['success' => true]);
    }

    public function withdrawPdf()
    {
        ini_set('max_execution_time', 300);
        $requestFiles = RequestFile::all();

        $requestIds = $requestFiles->pluck('request_id');

        $withdraws = Fund::with('clients')->whereIn('id', $requestIds)->get();

        $data['withdraws'] = $withdraws;

        $data['ceo'] = User::where('role', 'ceo')->first();
        $data['md'] = User::where('role', 'md')->first();
        $data['head'] = User::where('role', 'Business Head')->first();

        $pdf = app('dompdf.wrapper');
        $pdf = $pdf->loadView('admin.pdf.create', $data);

        $pdfPath = storage_path('app/public/withdraws_report.pdf');
        $pdf->save($pdfPath);


        Fund::whereIn('id', $requestIds)->update(['status' => 'approved']);

        RequestFile::whereIn('request_id', $requestIds)->delete();

        return $pdf->download('withdraws_report.pdf');


        return view('admin.pdf.create')->with($data);
    }

    public function updateReqStatus(Request $request, $id)
    {
        $role = auth()->user()->role;
        $withdraw = Fund::findOrFail($id);

        if($withdraw){
            if($role === 'ceo'){
                $withdraw->ceo = auth()->user()->name;
                $withdraw->ceostatus = 'decline';
                $withdraw->remark = $request->input('remark');
                $withdraw->md = NULL;
                $withdraw->mdstatus = NULL;

                $withdraw->save();

                return response()->json(['success' => true, 'message' => 'Request has been decline']);
            }

            $withdraw->md = auth()->user()->name;
            $withdraw->remark = 'Review Again';
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
            'reqId'          => 'required|integer',
            'portfolio_file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ]);

        if ($request->hasFile('portfolio_file')) {
            $file     = $request->file('portfolio_file');
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

    public function createPdf($id)
    {
        $data['withdraw'] = Fund::with('clients:id,name,trading_code,status')->where('id', $id)->first();
        $data['staff'] = Staff::find($data['withdraw']->approved_by);
        $data['bankInfo'] = BoAccount::where('bo_id', $data['withdraw']->clients->trading_code)->first();

        return view('admin.Request.auth.create')->with($data);
    }
}

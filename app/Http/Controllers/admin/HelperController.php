<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Fund;
use App\Models\User;
use App\Models\Staff;
use Barryvdh\DomPDF\PDF;
use App\Models\BoAccount;
use App\Models\RequestFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        foreach($ids as $id){
            $request = Fund::find($id);
            if($request->flag === 0){
                return response()->json(['error' => false]);
            }
            $alreadyExits = RequestFile::where('request_id', $id)->where('category', 'withdraw')->first();
            if(!$alreadyExits){
                $fileObj = new RequestFile();

                $fileObj->request_id = $id;
                $fileObj->created_by = auth()->user()->id;
                $fileObj->category = 'withdraw';
                $fileObj->save();
            }
        }
        return response()->json(['success' => true]);
    }

    public function withdrawPdf()
    {
        ini_set('max_execution_time', 300);
        $requestFiles = RequestFile::all();

        $requestIds = $requestFiles->pluck('request_id');

        $withdraws = Fund::with('clients')->whereIn('id', $requestIds)->where('ceostatus', 'approved')->where('mdstatus', 'approved')->get();
        if($withdraws->isEmpty()){
            return redirect()->back()->with('errorMsg', 'no files found');
        }
        $data['withdraws'] = $withdraws;

        $data['ceo']  = User::where('role', 'ceo')->first();
        $data['md']   = User::where('role', 'md')->first();
        $data['head'] = User::where('role', 'Business Head')->first();

        $pdf = app('dompdf.wrapper');
        $pdf = $pdf->loadView('admin.pdf.create', $data);

        $pdfPath = storage_path('app/public/withdraws_report.pdf');
        $pdf->save($pdfPath);


        Fund::whereIn('id', $requestIds)->where('ceostatus', 'approved')->where('mdstatus', 'approved')->update(['status' => 'approved']);

        RequestFile::whereIn('request_id', $requestIds)->delete();

        return $pdf->download('withdraws_report.pdf');


        return view('admin.pdf.create')->with($data);
    }

    public function updateStatus(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'red_id' => ['required'],
                'status' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $reqId = $request->input('red_id');
            $status = $request->input('status');

            $fund = Fund::findOrFail($reqId);

            if($fund){
                if($status === 'approved'){
                    $fund->approved_by = auth()->user()->id;
                }elseif($status === 'rejected'){
                    $fund->declined_by = auth()->user()->id;
                }
                $fund->status = $status;

                $res = $fund->save();
                DB::commit();
                if($res){
                    return back()->with('message', 'Request updated successfully..!');
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
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
        $role   = auth()->user()->role;
        $status = $request->input('status');

        $withdraw = Fund::findOrFail($id);

        if($withdraw){
            if($role === 'md'){
                $withdraw->md       = auth()->user()->name;
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

    public function sendRemark(Request $request)
    {
        $id = $request->input('id');
        $remark = $request->input('remark');

        if($id == '' || $remark == ''){
            return response()->json(['error' => false, 'message' => 'ID or Remark missing..Try Again...']);
        }

        $withdraw = Fund::findOrFail($id);
        if($withdraw){
            $withdraw->remark = $remark . ' - ' . auth()->user()->name . ' at ' . formatDateTime(Carbon::now());
            $res = $withdraw->save();
            if($res){
                return response()->json(['success' => true, 'message' => 'Remark added']);
            }
        }

        return response()->json(['error' => false, 'message' => 'ID or Remark missing..Try Again...']);
    }

    public function createPdf($id)
    {
        $data['withdraw'] = Fund::with('clients:id,name,trading_code,status')->where('id', $id)->first();
        $data['staff'] = Staff::find($data['withdraw']->approved_by);
        $data['bankInfo'] = BoAccount::where('bo_id', $data['withdraw']->clients->trading_code)->first();

        return view('admin.Request.auth.create')->with($data);
    }
}
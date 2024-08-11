<?php

namespace App\Http\Controllers\admin;

use App\Models\Fund;
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
        $withdraw = Fund::findOrFail($id);

        if($withdraw){
            $withdraw->md = auth()->user()->name;
            $withdraw->mdstatus = 'decline';

            $withdraw->save();

            return response()->json(['success' => true]);
        }
    }

    public function acceptReqStatus($id)
    {
        $withdraw = Fund::findOrFail($id);

        if($withdraw){
            $withdraw->md = auth()->user()->name;
            $withdraw->mdstatus = 'approved';

            $withdraw->save();

            return response()->json(['success' => true]);
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

            $reqId = $request->input('req_id');

            $withdraw = Fund::find($reqId);
            return $withdraw;

            if($withdraw){
                $withdraw->portfolio_file = $filePath;

                $withdraw->save();
            }
        }

        return response()->json(['success' => true, 'message' => 'File uploaded successfully.']);
    }
}

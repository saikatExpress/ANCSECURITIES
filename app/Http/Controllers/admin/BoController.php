<?php

namespace App\Http\Controllers\admin;

use App\Models\BOForm;
use App\Imports\BoImport;
use App\Models\BoAccount;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class BoController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function create()
    {
        $data['pageTitle'] = 'BO List';
        $data['bos'] = BoAccount::latest()->get();

        return view('admin.bo.create')->with($data);
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'bo_file' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($request->hasFile('bo_file')) {
            $file = $request->file('bo_file');
            $filePath = $file->storeAs('uploads', $file->getClientOriginalName());

            // Import the data to the database
            Excel::import(new BoImport, $filePath);

            return redirect()->back()->with('message','File uploaded and data imported successfully');
        }

        return response()->json(['error' => 'File upload failed'], 500);
    }

    public function acStore(Request $request)
    {
        try {
            DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            'boId' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $boObj = new BoAccount();

        $boObj->bo_id = $request->input('boId');
        $boObj->name = ($request->input('client_name')) ?? 'N/A';
        $boObj->ac_type = ($request->input('ac_type')) ?? 'N/A';

        $res = $boObj->save();

        DB::commit();
        if($res){
            return redirect()->back()->with('message', 'Successfully added');
        }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return false;
        }
    }

    public function showForm($id)
    {
        $client = BOForm::findOrFail($id);

        // return view('admin.bo.show', compact('client'));
        $pdf = PDF::loadView('admin.bo.test', compact('client'));
        return $pdf->download('client_information.pdf');
    }
}

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

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'firstname' => 'required|max:100',
                'lastname' => 'required|max:30',
                // Add other validation rules here
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->toArray()
                ]);
            }

            $boFormObj = new BOForm();

            $boFormObj->bo_type              = $request->input('bo_type');
            $boFormObj->type_of_client       = $request->input('type_of_client');
            $boFormObj->courtesy_title       = $request->input('courtesy_title');
            $boFormObj->firstname            = $request->input('firstname');
            $boFormObj->lastname             = $request->input('lastname');
            $boFormObj->occupation           = $request->input('occupation');
            $boFormObj->father_name          = $request->input('father_name');
            $boFormObj->mother_name          = $request->input('mother_name');
            $boFormObj->dob                  = $request->input('date_of_birth');
            $boFormObj->address_line_2       = $request->input('address_line_2', NULL);
            $boFormObj->address_line_3       = $request->input('address_line_3', NULL);
            $boFormObj->city                 = $request->input('city');
            $boFormObj->postal_code          = $request->input('post_code');
            $boFormObj->division             = $request->input('division');
            $boFormObj->country              = $request->input('country');
            $boFormObj->mobile               = $request->input('mobile');
            $boFormObj->email                = $request->input('email');
            $boFormObj->telephone            = $request->input('telephone');
            $boFormObj->fax                  = $request->input('fax');
            $boFormObj->nationality          = $request->input('nationality');
            $boFormObj->nid_no               = $request->input('nid');
            $boFormObj->tin                  = $request->input('tin');
            $boFormObj->broker_branch        = $request->input('branch');
            $boFormObj->residency            = $request->input('residency');
            $boFormObj->gender               = $request->input('gender');
            $boFormObj->director_company     = $request->input('director_company');
            $boFormObj->joint_courtesy_title = $request->input('joint_courtesy_title');
            $boFormObj->joint_firstname      = $request->input('joint_firstname');
            $boFormObj->joint_lastname       = $request->input('joint_lastname');
            $boFormObj->joint_occupation     = $request->input('joint_occupation');
            $boFormObj->joint_date_of_birth  = $request->input('joint_date_of_birth');
            $boFormObj->joint_father_name    = $request->input('joint_father_name');
            $boFormObj->joint_mother_name    = $request->input('joint_mother_name');
            $boFormObj->joint_nid            = $request->input('joint_nid');
            $boFormObj->joint_address_line_1 = $request->input('joint_address_line_1');
            $boFormObj->joint_address_line_2 = $request->input('joint_address_line_2');
            $boFormObj->joint_address_line_3 = $request->input('joint_address_line_3');
            $boFormObj->joint_city           = $request->input('joint_city');
            $boFormObj->joint_post_code      = $request->input('joint_post_code');
            $boFormObj->joint_division       = $request->input('joint_division');
            $boFormObj->joint_country        = $request->input('joint_country');
            $boFormObj->joint_email          = $request->input('joint_email');
            $boFormObj->joint_mobile         = $request->input('joint_mobile');
            $boFormObj->joint_telephone      = $request->input('joint_telephone');
            $boFormObj->joint_fax            = $request->input('joint_fax');

            $boFormObj->save();
            DB::commit();

            return response()->json([
                'success' => true,
                'id' => $boFormObj->id
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again.']);
        }
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

    public function openBoForm()
    {
        return view('admin.bo.bo');
    }

    public function showForm($id)
    {
        $client = BOForm::findOrFail($id);

        // return view('admin.bo.show', compact('client'));
        $pdf = PDF::loadView('admin.bo.test', compact('client'));
        return $pdf->download('client_information.pdf');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Models\Staff;
use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\StaffService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {

    }

    public function create()
    {
        $pageTitle = 'Create Staff';
        $designations = Designation::all();

        return view('admin.staff.create', compact('pageTitle', 'designations'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $staffObj = new Staff;
            $staffServiceObj = new StaffService;

            $validatedData = $request->validate([
                'image'             => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'branch-slug'       => 'required',
                'name'              => 'required',
                'email'             => 'required|email',
                'designation_id'    => 'required',
                'mobile'            => 'required',
                'permanent_address' => 'required',
                'present_address'   => 'required',
                'basic_salary'      => 'required',
                'nid'               => 'required',
                'nationality'       => 'required',
            ]);

            if ($request->hasFile('image')) {
                // Get the file name with extension
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                // Get just the file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get just the extension
                $extension = $request->file('image')->getClientOriginalExtension();
                // File name to store
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                // Upload image to the storage folder
                $path = $request->file('image')->storeAs('public/staffs', $fileNameToStore);
            } else {
                $fileNameToStore = 'noimage.jpg'; // Default image if no image is uploaded
            }

            $staffObj->branch_slug       = $request->input('branch-slug');
            $staffObj->name              = Str::title($request->input('name'));
            $staffObj->slug              = Str::slug($request->input('name'), '-');
            $staffObj->email             = $request->input('email');
            $staffObj->designation_id    = $request->input('designation_id');
            $staffObj->mobile            = $request->input('mobile');
            $staffObj->permanent_address = $request->input('permanent_address');
            $staffObj->present_address   = $request->input('present_address');
            $staffObj->basic_salary      = $request->input('basic_salary');
            $staffObj->nid               = $request->input('nid');
            $staffObj->birth_certificate = $request->input('birth_certificate');
            $staffObj->nationality       = $request->input('nationality');
            $staffObj->status            = $request->input('status');
            $staffObj->staff_image       = $fileNameToStore;

            $res = $staffObj->save();

            DB::commit();
            if($res){
                $remember   = $request->input('remember');
                $branchSlug = $request->input('branch-slug');
                $name       = $request->input('name');
                $email      = $request->input('email');
                $mobile     = $request->input('mobile');
                $role     = $request->input('role');

                if($remember == 1){
                    $result = $staffServiceObj->userCreate($name, $email, $mobile,$branchSlug, $role);
                    if($result == 1){
                        return redirect()->back()->with('message', 'Staff & User create successfully');
                    }
                }

                return redirect()->back()->with('message', 'Staff create successfully');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

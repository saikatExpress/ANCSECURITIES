<?php

namespace App\Http\Controllers\admin;

use App\Models\Staff;
use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\StaffService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
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
        $pageTitle = 'Staff List';
        $staffs    = Staff::all();

        return view('admin.staff.index', compact('pageTitle', 'staffs'));
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

            $request->validate([
                'image'             => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
                'branch-slug'       => 'nullable',
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
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                $path = $request->file('image')->storeAs('public/staffs', $fileNameToStore);
            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            $staffObj->branch_slug       = $request->input('branch-slug', null);
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
                $name       = $request->input('name');
                $email      = $request->input('email');
                $mobile     = $request->input('mobile');
                $role       = $request->input('role');

                if($remember == 1){
                    $result = $staffServiceObj->userCreate((string)$name, $email, $mobile, (string)$role);
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

    public function createAttendance()
    {
        $pageTitle = 'Create Attendance';
        $staffs    = Staff::where('status', '1')->get();

        return view('admin.staff.attendance.create', compact('pageTitle', 'staffs'));
    }

    public function attendanceStore(Request $request)
    {
        return $request->all();
        $staffIds = $request->input('staff_id');

        foreach($staffIds as $key => $staffId){
            $attendanceObj = new Attendance();

            $attendanceObj->staff_id = $staffId;
            $attendanceObj->in_time = $request->input('in_time_'.$staffId);
            $attendanceObj->out_time = $request->input('out_time_'.$staffId);
            $attendanceObj->status = ($request->input('attendance_status_'.$staffId)) ? 'present' : 'absent';

            $attendanceObj->save();
        }

        return back()->with('message', 'Attendance created');
    }
}

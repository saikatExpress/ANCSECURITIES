<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Attendance;
use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\StaffService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $pageTitle    = 'Create Staff';
        $designations = Designation::all();
        $roles = Role::all();

        return view('admin.staff.create', compact('pageTitle', 'designations', 'roles'));
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
                    $result = $staffServiceObj->userCreate((string)$name, $email, $mobile, (string)$role, $fileNameToStore);
                    if($result == 1){
                        return redirect()->back()->with('message', 'Staff & User create successfully');
                    }
                }
                return redirect()->back()->with('message', 'Staff create successfully');
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

    // AttendanceController.php
    public function empattendanceStore(Request $request)
    {
        try {
            $request->validate([
                'start_time' => 'required|date_format:H:i',
            ]);

            $alreadyAttend = Attendance::whereDate('attendance_date', Carbon::now())->where('staff_id', Auth::id())->first();
            if($alreadyAttend){
                return response()->json(['error' => false]);
            }

            $attendance = new Attendance();

            $year = date("Y");

            $attendance->attendance_date = Carbon::now();
            $attendance->year            = $year;
            $attendance->staff_id        = Auth::id();
            $attendance->in_time         = $request->input('start_time');

            $attendance->save();

            return response()->json(['message' => 'Attendance recorded successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to record attendance. Please try again.'], 500);
        }
    }


    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'image'             => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
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

            $staffServiceObj = new StaffService;

            $staff = Staff::findOrFail($request->input('staff_id'));

            // Initialize variable for file name
            $fileNameToStore = $staff->staff_image; // Use the existing image by default

            if ($request->hasFile('image')) {
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                $request->file('image')->storeAs('public/staffs', $fileNameToStore);

                // Delete old image if it's not the default image
                if ($staff->staff_image && $staff->staff_image != 'noimage.jpg') {
                    Storage::delete('public/staffs/' . $staff->staff_image);
                }
            }

            $staff->branch_slug       = $request->input('branch-slug', null);
            $staff->name              = Str::title($request->input('name'));
            $staff->slug              = Str::slug($request->input('name'), '-');
            $staff->email             = $request->input('email');
            $staff->designation_id    = $request->input('designation_id');
            $staff->mobile            = $request->input('mobile');
            $staff->permanent_address = $request->input('permanent_address');
            $staff->present_address   = $request->input('present_address');
            $staff->basic_salary      = $request->input('basic_salary');
            $staff->nid               = $request->input('nid');
            $staff->birth_certificate = $request->input('birth_certificate');
            $staff->nationality       = $request->input('nationality');
            $staff->status            = $request->input('status');
            $staff->staff_image       = $fileNameToStore;

            $res = $staff->save();

            DB::commit();

            if ($res) {
                $name       = $request->input('name');
                $email      = $request->input('email');
                $mobile     = $request->input('mobile');
                $role       = $request->input('role');

                $result = $staffServiceObj->userUpdate((string)$name, $email, $mobile, (string)$role, $fileNameToStore);
                if ($result == 1) {
                    return redirect()->back()->with('message', 'Staff & User updated successfully');
                }
                return redirect()->back()->with('message', 'Staff updated successfully');
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return redirect()->back()->withErrors('An error occurred while updating the staff.');
        }
    }


    public function edit($id)
    {
        $data['pageTitle'] = 'Edit staff';
        $data['designations'] = Designation::all();
        $data['roles'] = Role::all();

        $data['staff'] = Staff::with('designation:id,name')->where('id',$id)->first();

        $data['userRole'] = User::where('email', $data['staff']->email)->pluck('role')->first();

        return view('admin.staff.edit')->with($data);
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

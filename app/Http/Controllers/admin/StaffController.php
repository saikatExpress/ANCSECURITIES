<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Staff;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\StaffService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $departments = Department::all();
        $roles = Role::all();

        return view('admin.staff.create', compact('pageTitle', 'designations', 'roles','departments'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $staffObj = new Staff;

            $request->validate([
                'image'             => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
                'branch-slug'       => 'nullable',
                'name'              => 'required',
                'email'             => 'required|email|unique:staff,email',
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

            $remember   = $request->input('remember');
            $name       = $request->input('name');
            $email      = $request->input('email');
            $mobile     = $request->input('mobile');
            $role       = $request->input('role');

            $user = User::where('email', $email)->first();

            if($user){
                return redirect()->back()->with('errors', 'Sorry this email already assigned in users.Try another one..!');
            }

            if($remember == 1){
                $userObj = new User();

                $userObj->profile_image = $fileNameToStore;
                $userObj->name          = $name;
                $userObj->email         = $email;
                $userObj->mobile        = $mobile;
                $userObj->whatsapp      = $mobile;
                $userObj->role          = $role;
                $userObj->password      = Hash::make(123456);

                $res = $userObj->save();
                DB::commit();

                if($res){
                    $staffObj->id                = $userObj->id;
                    $staffObj->branch_slug       = $request->input('branch-slug', null);
                    $staffObj->name              = Str::title($name);
                    $staffObj->slug              = Str::slug($name, '-');
                    $staffObj->email             = $email;
                    $staffObj->email             = $email;
                    $staffObj->department_id     = $request->input('department_id');
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
                    if($res){
                        return redirect()->back()->with('message', 'Staff & User create successfully');
                    }
                    return redirect()->back()->with('message', 'Staff create successfully');
                }
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

    public function updateAttendanceStatus(Request $request, $employeeId)
    {
        $request->validate([
            'in_time' => 'nullable|date_format:H:i',
            'out_time' => 'nullable|date_format:H:i',
        ]);

        $emplyoeeAttendance = Attendance::where('staff_id', $employeeId)->whereDate('attendance_date', Carbon::today())->first();

        if($emplyoeeAttendance){
            $emplyoeeAttendance->attendance_date = Carbon::now();
            $emplyoeeAttendance->year            = date("Y");
            $emplyoeeAttendance->staff_id        = $employeeId;
            $emplyoeeAttendance->in_time         = $request->input('in_time', NULL);
            $emplyoeeAttendance->out_time        = $request->input('out_time', NULL);
            if($request->input('in_time') === NULL && $request->input('out_time') === NULL){
                $emplyoeeAttendance->status          = 'leave';
            }else{
                $emplyoeeAttendance->status          = 'accepted';
            }

            $res = $emplyoeeAttendance->save();

            if($res){
                return response()->json(['success' => true]);
            }
        }else{
            $attendanceObj = new Attendance();

            $attendanceObj->attendance_date = Carbon::now();
            $attendanceObj->year            = date("Y");
            $attendanceObj->staff_id        = $employeeId;
            $attendanceObj->in_time         = $request->input('in_time', NULL);
            $attendanceObj->out_time        = $request->input('out_time', NULL);
            if($request->input('in_time') === NULL && $request->input('out_time') === NULL){
                $attendanceObj->status          = 'leave';
            }else{
                $attendanceObj->status          = 'accepted';
            }

            $res = $attendanceObj->save();
            if($res){
                return response()->json(['success' => true]);
            }
        }

        $employee = Staff::find($employeeId);


        $employee->update([
            'status'   => 'accepted',
            'in_time'  => $request->input('in_time', NULL),
            'out_time' => $request->input('out_time', NULL),
        ]);

        return response()->json(['success' => true]);
    }

    public function updateAllAttendance(Request $request)
    {
        $updates = $request->input('updates');

        try {
            foreach ($updates as $update) {
                $employeeId = $update['employeeId'];
                $inTime = $update['inTime'];
                $outTime = $update['outTime'];

                $emplyoeeAttendance = Attendance::where('staff_id', $employeeId)->whereDate('attendance_date', Carbon::today())->first();

                if($emplyoeeAttendance){
                    $emplyoeeAttendance->attendance_date = Carbon::now();
                    $emplyoeeAttendance->year            = date("Y");
                    $emplyoeeAttendance->staff_id        = $employeeId;
                    $emplyoeeAttendance->in_time         = ($inTime) ?? NULL;
                    $emplyoeeAttendance->out_time        = ($outTime) ?? NULL;
                    if($inTime === NULL && $outTime === NULL){
                        $emplyoeeAttendance->status = 'leave';
                    }else{
                        $emplyoeeAttendance->status = 'accepted';
                    }

                    $emplyoeeAttendance->save();
                }else{
                    $attendanceObj = new Attendance();

                    $attendanceObj->attendance_date = Carbon::now();
                    $attendanceObj->year            = date("Y");
                    $attendanceObj->staff_id        = $employeeId;
                    $attendanceObj->in_time         = ($inTime) ?? NULL;
                    $attendanceObj->out_time        = ($outTime) ?? NULL;
                    if($inTime === NULL && $outTime === NULL){
                        $attendanceObj->status = 'leave';
                    }else{
                        $attendanceObj->status = 'accepted';
                    }

                    $attendanceObj->save();
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Failed to update attendance records.']);
        }
    }

    public function empattendanceStore(Request $request)
    {
        try {
            $request->validate([
                'start_time' => 'nullable|date_format:H:i',
                'out_time' => 'nullable|date_format:H:i',
            ]);

            $attendance = Attendance::whereDate('attendance_date', Carbon::now())
                ->where('staff_id', Auth::id())
                ->first();

            if ($request->has('start_time')) {
                if ($attendance) {
                    return response()->json(['error' => 'Already recorded.'], 400);
                }

                $attendance = new Attendance();
                $attendance->attendance_date = Carbon::now();
                $attendance->year = date("Y");
                $attendance->staff_id = Auth::id();
                $attendance->in_time = $request->input('start_time');
                $attendance->save();

                return response()->json([
                    'message' => 'In Time recorded successfully!',
                    'in_time' => $attendance->in_time,
                ], 200);
            }

            if ($request->has('out_time')) {
                if (!$attendance) {
                    return response()->json(['error' => 'No in time record found.'], 400);
                }

                $attendance->out_time = $request->input('out_time');
                $attendance->save();

                return response()->json([
                    'message' => 'Out Time recorded successfully!',
                    'out_time' => $attendance->out_time,
                ], 200);

                return response()->json(['message' => 'Out Time recorded successfully!'], 200);
            }

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

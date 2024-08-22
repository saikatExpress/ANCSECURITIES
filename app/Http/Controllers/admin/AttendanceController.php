<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function create()
    {
        $pageTitle = 'Create Attendance';
        $staffs    = Staff::where('status', '1')->get();

        return view('admin.staff.attendance.create', compact('pageTitle', 'staffs'));
    }

    public function store(Request $request)
    {
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
}

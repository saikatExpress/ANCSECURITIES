<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function attendanceReport(Request $request)
    {
        $data['pageTitle'] = 'Attendance Report';
        $data['staffs'] = Staff::all();

        $year = $request->input('year', now()->year);
        $month = $request->input('month', now()->month);
        $employeeId = $request->input('employee');

        // Initialize query
        $query = Attendance::with('user')->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month);

        // Apply employee filter if provided
        if ($employeeId) {
            $query->where('staff_id', $employeeId);
        }

        // Fetch the attendance data
        $data['attendanceReports'] = $query->get()
            ->map(function($report) {
                $report->formatted_in_time = $report->in_time ? Carbon::createFromFormat('H:i', $report->in_time)->format('h:i A') : 'N/A';
                $report->formatted_out_time = $report->out_time ? Carbon::createFromFormat('H:i', $report->out_time)->format('h:i A') : 'N/A';
                return $report;
            });

        return view('admin.report.attendancereport')->with($data);
    }
}

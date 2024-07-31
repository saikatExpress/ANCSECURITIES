<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Expense;
use Barryvdh\DomPDF\PDF;
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

    public function expenseReport(Request $request)
    {
        $data['pageTitle'] = 'Expense Report';

        $query = Expense::with('staff:id,name');

        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('expense_date', [$request->from_date, $request->to_date]);
        } else {
            $query->whereDate('expense_date', today());
        }

        $data['expenses'] = $query->get();

        return view('admin.report.expensereport')->with($data);
    }

    public function downloadExpenseReport(Request $request, $type)
    {
        $query = Expense::with('staff:id,name');

        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('expense_date', [$request->from_date, $request->to_date]);
        } else {
            $query->whereDate('expense_date', today());
        }

        $expenses = $query->get();

        if ($type == 'pdf') {
            $pdf = app('dompdf.wrapper');
            $pdf = $pdf->loadView('admin.report.pdf.expensepdf', compact('expenses'));
            return $pdf->download('expense_report.pdf');
        } elseif ($type == 'excel') {
            return Excel::download(new ExpenseExport($expenses), 'expense_report.xlsx');
        }
    }
}

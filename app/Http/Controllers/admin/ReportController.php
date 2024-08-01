<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Staff;
use App\Models\Expense;
use Barryvdh\DomPDF\PDF;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Exports\ExpenseExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        $data['employees'] = Staff::all();

        $query = Expense::with('staff:id,name');

        if ($request->filled('from_date')) {
            $query->whereDate('expense_date', '>=', $request->input('from_date'));
        }
        if ($request->filled('to_date')) {
            $query->whereDate('expense_date', '<=', $request->input('to_date'));
        }
        if ($request->filled('employee_id') && $request->input('employee_id') != 'All') {
            $query->where('staff_id', $request->input('employee_id'));
        }
        if($request->filled('category') && $request->input('category') != 'All'){
            $query->where('expense_category', $request->input('category'));
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $data['expenses'] = $query->orderBy('id', 'desc')->get();
        $data['expenses'] = $query->get();
        if ($request->ajax()) {
            return view('admin.report.partials.index', $data)->render();
        }

        return view('admin.report.expensereport')->with($data);
    }

    public function downloadExpenseReport(Request $request)
    {
        $query = Expense::query();

        $fromDate = $request->filled('from_date') ? $request->input('from_date') : null;
        $toDate = $request->filled('to_date') ? $request->input('to_date') : null;
        $category = $request->filled('category') && $request->input('category') != 'All' ? $request->input('category') : null;

        if ($fromDate) {
            $query->whereDate('expense_date', '>=', $fromDate);
        }
        if ($toDate) {
            $query->whereDate('expense_date', '<=', $toDate);
        }
        if ($request->filled('employee_id') && $request->input('employee_id') != 'All') {
            $query->where('staff_id', $request->input('employee_id'));
        }
        if ($category) {
            $query->where('expense_category', $category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Get filtered data
        $expenses = $query->orderBy('id', 'desc')->get();

        $totalAmount = $expenses->sum('amount');

        // Check the type and generate the report
        $type = $request->input('type');

        if ($type == 'pdf') {
            $pdf = app('dompdf.wrapper');
            // return view('admin.report.pdf.expensepdf', compact('expenses', 'totalAmount', 'fromDate', 'toDate', 'category'));
            $pdf = $pdf->loadView('admin.report.pdf.expensepdf', compact('expenses', 'totalAmount', 'fromDate', 'toDate', 'category'));
            return $pdf->download('expense_report.pdf');
        } elseif ($type == 'excel') {
            return Excel::download(new ExpenseExport($expenses), 'expense_report.xlsx');
        }
    }
}

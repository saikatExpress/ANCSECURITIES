<?php

namespace App\Http\Controllers\admin;

use App\Models\Staff;
use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    public function create()
    {
        $data['pageTitle'] = 'Create Salary';
        $data['employees'] = Staff::all();
        $data['salaries'] = Salary::with('employee')->get();

        return view('admin.staff.salary')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:staff,id',
            'amount' => 'required|numeric|min:0',
            'salary_month' => 'required|date_format:Y-m',
        ]);

        // Store the salary
        Salary::updateOrCreate(
            ['employee_id' => $request->input('employee_id'), 'salary_month' => $request->input('salary_month')],
            ['amount' => $request->input('amount')]
        );

        return redirect()->back()->with('message', 'Salary saved successfully!');
    }
}

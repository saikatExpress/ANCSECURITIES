<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\EmployeeWork;
use Illuminate\Support\Facades\Auth;

class ActivityService
{
    public function withdrawActivityService()
    {
        $employeeWorksObj = new EmployeeWork();

        $employeeWorksObj->staff_id         = Auth::id();
        $employeeWorksObj->work_title       = 'Created a withdraw request';
        $employeeWorksObj->category         = auth()->user()->role;
        $employeeWorksObj->assign_work_date = Carbon::now();
        $employeeWorksObj->work_status      = 'pending';
        $employeeWorksObj->status           = 1;
        $employeeWorksObj->created_at       = Carbon::now();

        $employeeWorksObj->save();
    }
}
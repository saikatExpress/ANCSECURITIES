<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\EmployeeWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public static function workStore($category)
    {
        try {
            DB::beginTransaction();

            if ($category === 'account') {
                $accountStaff = User::where('role', $category)
                                    ->where('status', 'active')
                                    ->get();

                if ($accountStaff->isEmpty()) {
                    // Handle case where no active account staff found
                    info('No active account staff found');
                } else {
                    foreach ($accountStaff as $staff) {
                        $employeeWorkObj = new EmployeeWork();
                        $employeeWorkObj->staff_id = $staff->id;
                        $employeeWorkObj->work_title = 'You have a new expense request';
                        $employeeWorkObj->category = $category;
                        $employeeWorkObj->assign_work_date = Carbon::now();
                        $employeeWorkObj->save();
                    }

                    DB::commit();
                }
            } else {
                info('Category not supported');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            // Handle exception
        }
    }
}

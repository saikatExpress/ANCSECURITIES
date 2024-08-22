<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Fund;
use App\Models\User;
use App\Models\Staff;
use App\Models\BOForm;
use App\Models\Account;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Setting;
use App\Models\BoAccount;
use App\Models\Attendance;
use App\Models\EmployeeWork;
use App\Models\LimitRequest;
use Illuminate\Http\Request;
use App\Mail\RegistrationSuccess;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['todayCost'] = Expense::where('expense_date', Carbon::today())->sum('amount');

        if(auth()->user()->role === 'hr' || auth()->user()->role === 'admin' || auth()->user()->role === 'ceo' || auth()->user()->role === 'Business Head'){
            $data['employees'] = DB::table('users')
            ->leftJoin('attendances', function ($join) {
                $join->on('users.id', '=', 'attendances.staff_id')
                    ->whereDate('attendances.created_at', Carbon::today());
            })
            ->where('users.role', '!=', 'user')
            ->where('users.role', '!=', 'admin')
            ->whereNot('users.role', 'ceo')
            ->whereNot('users.role', 'md')
            ->select(
                'users.id',
                'users.name',
                'users.profile_image',
                'users.email',
                'users.mobile',
                'users.whatsapp',
                'users.address',
                'users.role',
                'attendances.in_time',
                'attendances.out_time',
                'attendances.status'
            )
            ->get();
        }

        $data['todayAttendance'] = Attendance::where('staff_id', Auth::id())->whereDate('attendance_date', Carbon::today())->first();
        $attendance = Attendance::where('staff_id', Auth::id())
            ->whereMonth('attendance_date', Carbon::now()->month)
            ->whereYear('attendance_date', Carbon::now()->year)
            ->first();

        if ($attendance) {
            if ($attendance->in_time && $attendance->out_time) {
                try {
                    $attendanceDate = Carbon::parse($attendance->attendance_date);

                    $inTime = Carbon::parse($attendanceDate->format('Y-m-d') . ' ' . $attendance->in_time);
                    $outTime = Carbon::parse($attendanceDate->format('Y-m-d') . ' ' . $attendance->out_time);

                    $totalHours = $outTime->diffInHours($inTime);

                    $data['totalHours'] = $totalHours;

                } catch (\Exception $e) {
                    $data['totalHours'] = 'Error: ' . $e->getMessage();
                }
            } else {
                $data['totalHours'] = 0;
            }
        } else {
            $data['totalHours'] = 0;
        }

        if(in_array(auth()->user()->role, ['ceo', 'admin', 'md', 'Business Head'])){
            $data['recent_products'] = Product::latest()->take(5)->get();
        }

        $data['todayWorks'] = EmployeeWork::whereDate('assign_work_date', Carbon::today())->where('category', auth()->user()->role)->get();
        $data['totalDeposit'] = Fund::where('category', 'deposit')->where('status', 'approved')->sum('amount');
        $data['thisMonthDepositCount'] = $this->getMonthlyDepositCount();
        $data['totalDepositCount'] = Fund::where('category', 'deposit')
                      ->where('status', 'approved')
                      ->count();

        $data['wrequests'] = Fund::with('clients:id,name,trading_code')->where('category', 'withdraw')->where('status', 'pending')->get();
        if(auth()->user()->role === 'account'){
            $data['balance'] = Account::first();

            $data['pendingExpenses'] = Expense::with('staff:id,name')->where('status', 'pending')->whereDate('expense_date', Carbon::today())->get();
        }

        if(auth()->user()->role === 'Business Head' || auth()->user()->role === 'hr'){
            if(auth()->user()->role === 'Business Head'){
                $data['waitingExpenses'] = Expense::where('assign_to_ceo', 1)->get();
            }
            if(auth()->user()->role === 'hr'){
                $data['waitingExpenses'] = Expense::where('assign_to_hr', 1)->get();
            }
        }

        $data['authUserExpense'] = Expense::with('staff:id,name')->where('staff_id', Auth::id())->get();

        $data['totalUsers'] = User::where('role', 'user')->count();
        $data['activeUsers'] = User::where('role', 'user')->where('status', 'active')->count();
        $data['latestUsers'] = User::where('role', 'user')->latest()->take(8)->get();

        $notifications = [];

        $limits   = LimitRequest::with('clients:id,name,email,mobile,whatsapp,trading_code')->where('status', 'pending')->get();
        $withdraw = Fund::with('clients:id,name,email,mobile,whatsapp,trading_code')->where('category', 'withdraw')->where('status', 'pending')->get();
        $deposite = Fund::with('clients:id,name,email,mobile,whatsapp,trading_code')->where('category', 'deposit')->where('status', 'pending')->get();

        if(auth()->user()->role === 'admin'){
            $data['allStaffs'] = Staff::where('status', '1')->get();
        }

        foreach ($limits as $limit) {
            $notifications[] = [
                'type' => 'limit',
                'data' => $limit,
                'created_at' => $limit->created_at
            ];
        }

        foreach ($withdraw as $withdraw) {
            $notifications[] = [
                'type' => 'withdraw',
                'data' => $withdraw,
                'created_at' => $withdraw->created_at
            ];
        }

        foreach ($deposite as $deposit) {
            $notifications[] = [
                'type' => 'deposit',
                'data' => $deposit,
                'created_at' => $deposit->created_at
            ];
        }

        usort($notifications, function($a, $b) {
            return $b['created_at']->timestamp - $a['created_at']->timestamp;
        });

        $data['browserHistory'] = User::where('role', 'user')->pluck('user_agent');

        if(auth()->user()->role === 'md'){
            $data['withdraws'] = Fund::with('clients:id,name')->where('category', 'withdraw')->where('status', 'pending')->get();
        }

        $res = LimitRequest::selectRaw('COUNT(*) as totalRequests, SUM(limit_amount) as totalAmount')
                    ->whereDate('created_at', now()->today())
                            ->first();

        $totalRequests = $res->totalRequests;
        $totalAmount   = $res->totalAmount;

        return view('admin.home.index', compact('notifications', 'totalRequests', 'totalAmount'))->with($data);
    }

    public function getMonthlyDepositCount()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $monthlyDepositCount = Fund::where('category', 'deposit')
                                ->where('status', 'approved')
                                ->whereMonth('withdraw_date', $currentMonth)
                                ->whereYear('withdraw_date', $currentYear)
                                ->count();

        return $monthlyDepositCount;
    }

    public function create()
    {
        $userRole = auth()->user()->role;
        $allowedRoles = ['admin', 'it', 'Business Head', 'hr'];

        if (!in_array($userRole, $allowedRoles)) {
            return redirect()->back()->with('error', 'This page is not permitted for you..!');
        }

        $pageTitle = 'Create Director';

        return view('admin.director.create', compact('pageTitle'));
    }

    public function profile()
    {
        return view('admin.profile.create');
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'trading_code' => 'required|string|max:255',
                'name'         => 'nullable|string|max:255',
                'email'        => 'nullable|email|max:255',
                'mobile'       => 'nullable|string|max:255',
                'whatsapp'     => 'nullable|string|max:255',
                'status'       => 'nullable',
            ]);

            $userId = $request->input('userId');

            $userInfo = User::where('id', $userId)->where('role', 'user')->first();

            if($userInfo){
                $userInfo->name         = $validatedData['name'];
                $userInfo->email        = $validatedData['email'];
                $userInfo->mobile       = $validatedData['mobile'];
                $userInfo->trading_code = $validatedData['trading_code'];
                $userInfo->whatsapp     = $validatedData['whatsapp'];
                $userInfo->status       = $validatedData['status'];

                $res = $userInfo->save();

                DB::commit();
                if($res){
                    return redirect()->back()->with('message', 'User update successfully');
                }
            }

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return false;
        }
    }

    public function boIndex()
    {
        $pageTitle = 'BO Form List';
        $boForms = BOForm::latest()->get();

        return view('admin.bo.index', compact('pageTitle', 'boForms'));
    }
}

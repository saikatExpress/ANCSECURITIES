<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use App\Models\BoAccount;
use App\Models\EmployeeWork;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Mail\RegistrationSuccess;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->ajax()){
            $search = $request->get('search');
            $perPage = $request->get('per_page', 10);

            $user = User::query()
                ->when($search, function($query, $search){
                    return $query->where('id','like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%")
                                ->orWhere('mobile', 'like', "%{$search}%")
                                ->orWhere('whatsapp', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('trading_code', 'like', "%{$search}%");
                })
                ->where('role', 'user')
                ->latest()
                ->paginate($perPage);

            return response()->json([
                'pagination' => [
                    'total'        => $user->total(),
                    'per_page'     => $user->perPage(),
                    'current_page' => $user->currentPage(),
                    'last_page'    => $user->lastPage(),
                    'from'         => $user->firstItem(),
                    'to'           => $user->lastItem()
                ],
                'data' => $user->items()
            ]);
        }
        $data['pageTitle'] = 'User List';
        $data['users']     = User::where('role', 'user')->paginate(10);

        return view('admin.user.index')->with($data);
    }

    public function activeUserIndex(Request $request)
    {
        if($request->ajax()){
            $search = $request->get('search');
            $perPage = $request->get('per_page', 10);

            $user = User::query()
                ->when($search, function($query, $search){
                    return $query->where('id','like', "%{$search}%")
                                ->orWhere('name', 'like', "%{$search}%")
                                ->orWhere('mobile', 'like', "%{$search}%")
                                ->orWhere('whatsapp', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%")
                                ->orWhere('trading_code', 'like', "%{$search}%");
                })
                ->where('role', 'user')
                ->where('status', 'active')
                ->latest()
                ->paginate($perPage);

            return response()->json([
                'pagination' => [
                    'total'        => $user->total(),
                    'per_page'     => $user->perPage(),
                    'current_page' => $user->currentPage(),
                    'last_page'    => $user->lastPage(),
                    'from'         => $user->firstItem(),
                    'to'           => $user->lastItem()
                ],
                'data' => $user->items()
            ]);
        }
        $data['pageTitle'] = 'User List';
        $data['users']     = User::where('role', 'user')->where('status', 'active')->paginate(10);

        return view('admin.user.active')->with($data);
    }

    public function create()
    {
        $userRole     = auth()->user()->role;
        $allowedRoles = ['admin', 'it', 'Business Head', 'hr'];

        if (!in_array($userRole, $allowedRoles)) {
            return redirect()->back()->with('error', 'This page is not permitted for you..!');
        }

        $pageTitle = 'Create User';

        $roles = Role::all();

        return view('admin.user.create', compact('pageTitle','roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'trading_code'    => 'nullable|string|max:255',
            'name'            => 'nullable|string|max:255',
            'email'           => 'nullable|email|unique:users|max:255',
            'mobile'          => 'nullable|unique:users|max:25',
            'bank_name'       => 'required|string|max:255',
            'branch_name'     => 'required|string|max:255',
            'bank_account_no' => 'required|string|max:255',
            'password'        => 'required|string|max:255',
            'profile_image'   => 'nullable|image|max:2048',
            'signature'       => 'nullable|image|max:2048',
        ]);

        $code          = $request->input('trading_code');
        $name          = $request->input('name');
        $email         = $request->input('email');
        $fatherName    = $request->input('father_name');
        $motherName    = $request->input('mother_name');
        $mobile        = $request->input('mobile');
        $whatsapp      = $request->input('whatsapp');
        $address       = $request->input('address');
        $bankName      = $request->input('bank_name');
        $bankAccountNo = $request->input('bank_account_no');
        $branchName    = $request->input('branch_name');
        $routingNumber = $request->input('routing_number');
        $password      = $request->input('password');
        $checkBo       = $request->input('checkBo');
        $role          = $request->input('role');

        $userExits = User::where('trading_code', $code)->first();
        if($userExits){
            return redirect()->back()->with('error', 'This account already opened..! ' . 'Name : '. $userExits->name);
        }

        if ($request->hasFile('profile_image')) {
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('profile_image')->storeAs('public/user_photo/profile', $fileNameToStore);
        }

        if ($request->hasFile('signature')) {
            $filenameWithExt = $request->file('signature')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('signature')->getClientOriginalExtension();
            $signature = $filename.'_'.time().'.'.$extension;
            $request->file('signature')->storeAs('public/user_photo/signature', $fileNameToStore);
        }

        $res = UserService::store(
            $code,
            (string) $name,
            $email,
            $fatherName,
            $motherName,
            $mobile,
            $whatsapp,
            $address,
            $bankName,
            $bankAccountNo,
            $branchName,
            $routingNumber,
            $password,
            (string) $fileNameToStore,
            (string) $signature,
            $checkBo,
            $role
        );

        if($res == true){
            $employeeWorkObj = new EmployeeWork();

            $employeeWorkObj->staff_id = Auth::id();
            $employeeWorkObj->work_title = auth()->user()->name . ' created an '. $role . ' named '. $name;
            $employeeWorkObj->category = 'createuser';
            $employeeWorkObj->remark = 'verified user';
            $employeeWorkObj->assign_work_date = Carbon::now();
            $employeeWorkObj->work_status = 'complete';
            $employeeWorkObj->status = '1';

            $employeeWorkObj->save();

            return redirect()->back()->with('message', 'User created successfully.');
        }
    }
}

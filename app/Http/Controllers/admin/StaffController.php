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
use Illuminate\Support\Facades\File;
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
        if(!in_array(auth()->user()->role, ['admin', 'hr', 'Business Head', 'it', 'account'])){
            return back()->with('message', 'This page is not permitted for you..!');
        }

        $pageTitle    = 'Create Staff';
        $designations = Designation::all();
        $departments  = Department::all();
        $roles        = Role::all();

        return view('admin.staff.create', compact('pageTitle', 'designations', 'roles','departments'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $staffObj = new Staff;

            $request->validate([
                'image'             => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
                'signature'         => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
                'branch-slug'       => 'nullable',
                'name'              => 'required',
                'email'             => 'required|email|unique:staff,email|unique:users,email',
                'designation_id'    => 'required',
                'department_id'     => 'required',
                'mobile'            => 'required|unique:staff,mobile|unique:users,mobile',
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
                $request->file('image')->storeAs('public/user_photo/profile', $fileNameToStore);
            }

            if ($request->hasFile('signature')) {
                $fileNameWithExt = $request->file('signature')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('signature')->getClientOriginalExtension();
                $signature = $fileName.'_'.time().'.'.$extension;
                $request->file('signature')->storeAs('public/user_photo/signature', $signature);
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
                $userObj->signature     = $signature;
                $userObj->name          = $name;
                $userObj->email         = $email;
                $userObj->address       = $request->input('permanent_address');
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
                    $staffObj->signature         = $signature;
                    $staffObj->designation_id    = $request->input('designation_id');
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
                    $staffObj->signature         = $signature;

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
        }
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'image'             => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
                'signature'         => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
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

            $fileNameToStore = $staff->staff_image;
            $signature = $staff->signature;

            if ($request->hasFile('image')) {
                $file = $staff->staff_image;
                if ($file) {
                    Storage::disk('public')->delete('user_photo/profile' . $file);

                    File::delete(public_path('user_photo/profile' . $file));
                }

                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                $request->file('image')->storeAs('public/user_photo/profile', $fileNameToStore);
            }

            if ($request->hasFile('signature')) {
                $file = $staff->signature;
                if ($file) {
                    Storage::disk('public')->delete('user_photo/signature' . $file);

                    File::delete(public_path('user_photo/signature' . $file));
                }

                $fileNameWithExt = $request->file('signature')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('signature')->getClientOriginalExtension();
                $signature = $fileName.'_'.time().'.'.$extension;
                $request->file('signature')->storeAs('public/user_photo/signature', $signature);
            }

            $staff->branch_slug       = $request->input('branch-slug', null);
            $staff->name              = Str::title($request->input('name'));
            $staff->slug              = Str::slug($request->input('name'), '-');
            $staff->email             = $request->input('email');
            $staff->signature         = $signature;
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

                $result = $staffServiceObj->userUpdate((string)$name, $email, $mobile, (string)$role, $fileNameToStore, $signature);
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
}

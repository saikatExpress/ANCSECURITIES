<?php

namespace App\Http\Controllers\admin;

use App\Models\Fund;
use App\Models\User;
use App\Models\BOForm;
use App\Models\LimitRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $data['totalUsers'] = User::where('role', 'user')->count();
        $data['latestUsers'] = User::where('role', 'user')->latest()->take(8)->get();

        $notifications = [];

        $limits   = LimitRequest::with('clients:id,name,email,mobile,whatsapp,trading_code')->where('status', 'pending')->get();
        $withdraw = Fund::with('clients:id,name,email,mobile,whatsapp,trading_code')->where('category', 'withdraw')->where('status', 'pending')->get();
        $deposite = Fund::with('clients:id,name,email,mobile,whatsapp,trading_code')->where('category', 'deposit')->where('status', 'pending')->get();

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

        return view('admin.home.index', compact('notifications'))->with($data);
    }

    public function userIndex()
    {
        $data['pageTitle'] = 'User List';
        $data['users'] = User::where('role', 'user')->get();

        return view('admin.user.index')->with($data);
    }

    public function create()
    {
        $pageTitle = 'Create Director';

        return view('admin.director.create', compact('pageTitle'));
    }

    public function createUser()
    {
        $pageTitle = 'Create User';
        $users = User::where('role', 'user')->get();

        return view('admin.user.create', compact('pageTitle', 'users'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'trading_code'  => 'required|string|max:255',
                'name'          => 'nullable|string|max:255',
                'email'         => 'nullable|email|max:255',
                'mobile'        => 'nullable|string|max:255',
                'password'      => 'nullable|string|max:255',
                'profile_image' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('profile_image')) {
                // Get filename with extension
                $filenameWithExt = $request->file('profile_image')->getClientOriginalName();

                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                // Get just extension
                $extension = $request->file('profile_image')->getClientOriginalExtension();

                // Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;

                // Upload Image
                $path = $request->file('profile_image')->storeAs('public/user_photo', $fileNameToStore);
            } else {
                $fileNameToStore = 'noimage.jpg';
            }

            DB::commit();
            $user = User::create([
                'trading_code'  => $validatedData['trading_code'],
                'name'          => $validatedData['name'],
                'email'         => $validatedData['email'],
                'mobile'        => $validatedData['mobile'],
                'whatsapp'      => $validatedData['mobile'],
                'password'      => Hash::make($validatedData['password']),
                'profile_image' => $fileNameToStore,
            ]);

            return redirect()->back()->with('message', 'User created successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
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

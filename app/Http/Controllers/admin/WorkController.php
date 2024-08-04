<?php

namespace App\Http\Controllers\admin;

use App\Models\Work;
use App\Models\Staff;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'Work List';
        $data['worksByDepartment'] = Work::with('department')->get() ->groupBy('department_id');;
        // return $data['works'];
        return view('admin.work.index')->with($data);
    }

    public function create()
    {
        $data['pageTitle'] = 'Create Work';
        $data['departments'] = Department::all();

        return view('admin.work.create')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

             $validator = Validator::make($request->all(), [
                'department_id' => 'required|exists:departments,id',
                'title.*'       => 'required|string|max:255',
                'description.*' => 'required|string',
                'status.*'      => 'required|in:Pending,In Progress,Completed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::commit();
            foreach ($request->title as $index => $title) {
                Work::create([
                    'department_id' => $request->input('department_id'),
                    'work_title' => $title,
                    'description' => $request->description[$index],
                    'created_by' => auth()->user()->name,
                    'status' => $request->status[$index],
                ]);
            }

        return redirect()->back()->with('message', 'Work created successfully');

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

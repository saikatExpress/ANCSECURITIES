<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeUnit\FunctionUnit;

class DepartmentController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'Department List';
        $data['departments'] = Department::all();

        return view('admin.department.index')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $departmentObj = new Department();

            $departmentObj->name        = Str::title($request->input('name'));
            $departmentObj->slug        = Str::slug($request->input('name'), '-');
            $departmentObj->description = Str::title($request->input('description'));
            $departmentObj->created_by  = auth()->user()->name;

            $res = $departmentObj->save();

            DB::commit();
            if($res){
                return back()->with('message','Department created successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return;
        }
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'dName' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $departmentId = $request->input('departmentId');
            $department   = Department::findOrFail($departmentId);

            $name        = $request->input('dName');
            $status      = $request->input('status');
            $description = $request->input('dDescription', NULL);

            if($department){
                $department->name        = Str::title($name);
                $department->slug        = Str::slug($name, '-');
                $department->description = $description;
                $department->updated_by  = auth()->user()->name;
                $department->status      = $status;
                $department->updated_at  = Carbon::now();

                $res = $department->save();

                DB::commit();
                if($res){
                    return response()->json(['success' => true]);
                }
            }

            return response()->json(['error' => false]);
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return;
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $department = Department::find($id);

            if (!$department) {
                return response()->json(['message' => 'Department not found.'], 404);
            }

            $res = $department->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Department deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

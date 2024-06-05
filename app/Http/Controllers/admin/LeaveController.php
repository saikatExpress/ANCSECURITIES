<?php

namespace App\Http\Controllers\admin;

use App\Models\Leave;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'Leave List';
        $data['leaves']    = Leave::all();

        return view('admin.leave.index')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'leave_type'      => ['required', 'string', 'max:250'],
                'number_of_leave' => ['required', 'integer']
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $leaveObj = new Leave();

            $leaveObj->leave_type      = Str::title($request->input('leave_type'));
            $leaveObj->slug      = Str::slug($request->input('leave_type'), '-');
            $leaveObj->number_of_leave = $request->input('number_of_leave');
            $leaveObj->created_by      = auth()->user()->name;

            $res = $leaveObj->save();

            DB::commit();
            if($res){
                return back()->with('message', 'Leave created successfully');
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
                'leave_type'      => ['required', 'string', 'max:250'],
                'number_of_leave' => ['required', 'integer']
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $leaveId = $request->input('leaveId');

            $leave = Leave::findOrFail($leaveId);

            if($leave){
                $leave->leave_type      = Str::title($request->input('leave_type'));
                $leave->slug            = Str::slug($request->input('leave_type'), '-');
                $leave->number_of_leave = $request->input('number_of_leave');
                $leave->updated_by      = auth()->user()->name;
                $leave->updated_at      = Carbon::now();

                $res = $leave->save();

                DB::commit();
                if($res){
                    return back()->with('message', 'Leave update successfully');
                }
            }
            return back()->with('error', 'Leave not found');
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

            $leave = Leave::find($id);

            if (!$leave) {
                return response()->json(['message' => 'Leave not found.'], 404);
            }

            $res = $leave->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Leave deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

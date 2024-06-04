<?php

namespace App\Http\Controllers\admin;

use App\Models\Designation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'Designation List';
        $data['designations'] = Designation::all();

        return view('admin.designation.index')->with($data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'name' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $name        = $request->input('name');
            $description = $request->input('description', NULL);

            $designationObj = new Designation();

            $designationObj->name        = Str::title($name);
            $designationObj->slug        = Str::slug($name, '-');
            $designationObj->description = $description;

            $res = $designationObj->save();

            DB::commit();
            if($res){
                return back()->with('message', 'Designation created successfully');
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

            $designationId        = $request->input('designationId');
            $designation = Designation::findOrFail($designationId);

            $name = $request->input('dName');
            $description = $request->input('dDescription', NULL);

            if($designation){
                $designation->name        = Str::title($name);
                $designation->slug        = Str::slug($name, '-');
                $designation->description = $description;

                $res = $designation->save();

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

            $designation = Designation::find($id);

            if (!$designation) {
                return response()->json(['message' => 'Designation not found.'], 404);
            }

            $res = $designation->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Designation deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

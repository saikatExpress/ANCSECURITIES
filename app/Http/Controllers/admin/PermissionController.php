<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $permissions = Permission::latest()->get();

        return view('admin.role.partials.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.role.partials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create([
            'name'       => $request->input('name'),
            'guard_name' => 'web',
        ]);

        return response()->json(['success' => 'Permission created successfully']);
    }

    public function update(Request $request)
    {
        $id = $request->input('permissionid');
        $permission             = Permission::find($id);
        $permission->name       = $request->input('name');
        $permission->guard_name = 'web';
        $permission->save();

        return response()->json(['success' => 'Permission updated successfully']);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $permission = Permission::find($id);

            if (!$permission) {
                return response()->json(['message' => 'Permission not found.'], 404);
            }

            $res = $permission->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Permission deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        if(!Auth::check()){
            return redirect()->route('logout.us');
        }
    }

    public function index()
    {
        $data['pageTitle'] = 'Role List';
        $data['roles'] = Role::with('permissions')->latest()->get();

        return view('admin.role.index')->with($data);
    }

    public function create()
    {
        $pageTitle = 'Create Role';
        $permissions = Permission::all();

        return view('admin.role.create', compact('pageTitle', 'permissions'));
    }

    public function fetchPermission($id)
    {
        $role = Role::with('permissions')->where('id', $id)->first();

        return response()->json(['role' => $role]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the input data
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'unique:roles,name'],
                'permissions.*' => ['required', 'exists:permissions,name'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Create the role
            $role = Role::create([
                'name' => $request->input('name'),
                'guard_name' => 'web'
            ]);

            // Sync permissions
            $permissions = $request->input('permissions');
            $role->syncPermissions($permissions);

            DB::commit();

            return back()->with('message', 'Role created successfully with permissions');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $role = ROle::find($id);

            if (!$role) {
                return response()->json(['message' => 'Role not found.'], 404);
            }

            $res = $role->delete();

            DB::commit();
            if($res){
                return response()->json(['message' => 'Role deleted successfully.']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }
    }
}

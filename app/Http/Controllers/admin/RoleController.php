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

    public function permissionIndex()
    {
        $permissions = Permission::all();

        return view('admin.role.partials.index', compact('permissions'));
    }

    public function create()
    {
        $pageTitle = 'Create Role';
        $permissions = Permission::all();

        return view('admin.role.create', compact('pageTitle', 'permissions'));
    }

    public function permissionCreate()
    {
        return view('admin.role.partials.create');
    }

    public function storePermission(Request $request)
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

    public function permissionUpdate(Request $request)
    {
        $id = $request->input('permissionid');
        $permission             = Permission::find($id);
        $permission->name       = $request->input('name');
        $permission->guard_name = 'web';
        $permission->save();

        return response()->json(['success' => 'Permission updated successfully']);
    }

    public function fetchPermission($id)
    {
        $role = Role::find($id);
        $permissions = $role->permissions;

        return view('admin.role.partials.permission', compact('permissions'));
    }


    public function editPermissions($roleId)
    {
        $role = Role::findById($roleId);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.role.partials.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function updatePermissions(Request $request, $roleId)
    {
        $role = Role::findById($roleId);
        $permissions = $request->input('permissions', []);

        $role->syncPermissions($permissions);

        return response()->json(['success' => true]);
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

    public function permissionDestroy($id)
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

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $role = Role::find($id);

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

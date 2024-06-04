<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);

        $permissions = [
            ['name' => 'user list'],
            ['name' => 'create user'],
            ['name' => 'edit user'],
            ['name' => 'delete user'],
            ['name' => 'role list'],
            ['name' => 'create role'],
            ['name' => 'edit role'],
            ['name' => 'delete role'],
            ['name' => 'staff list'],
            ['name' => 'create staff'],
            ['name' => 'edit staff'],
            ['name' => 'delete staff'],
            ['name' => 'banner list'],
            ['name' => 'create banner'],
            ['name' => 'edit banner'],
            ['name' => 'delete banner'],
            ['name' => 'gallery list'],
            ['name' => 'create gallery'],
            ['name' => 'edit gallery'],
            ['name' => 'delete gallery'],
            ['name' => 'about list'],
            ['name' => 'create about'],
            ['name' => 'edit about'],
            ['name' => 'delete about'],
            ['name' => 'form list'],
            ['name' => 'create form'],
            ['name' => 'edit form'],
            ['name' => 'delete form'],
        ];

        foreach($permissions as $key => $permission){
            Permission::create($permission);
        }

        $role->syncPermissions(Permission::all());

        $user = User::where('role', 'admin')->first();

        $user->assignRole($role);
    }
}

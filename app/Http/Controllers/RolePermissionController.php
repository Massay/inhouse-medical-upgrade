<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        return inertia('Settings/RolePermission', [
            'roles' => Role::all()
        ]);
    }

    public function show(Role $role)
    {
        return inertia('Settings/ShowRolePermission', [
            'role' => $role->load('permissions')
        ]);
    }

    public function create()
    {
        return inertia("Settings/CreateRole", [
            'permissions' => Permission::all()
        ]);
    }

    public function edit(Role $role){

        $rolePermissions = $role->permissions;
        $permissionsBelongingToRole = Permission::whereIn('id', $rolePermissions->pluck('id'))->get();
        $permissionsNotBelongingToRole = Permission::whereNotIn('id', $rolePermissions->pluck('id'))->get();


        return inertia("Settings/EditRole",[
            'role' => $role,
            'permissionsBelongingToRole' => $permissionsBelongingToRole,
            'permissionsNotBelongingToRole' => $permissionsNotBelongingToRole
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'selectedPermissions' => 'required'
        ]);

        app()['cache']->forget('spatie.permission.cache');

        DB::transaction(function () use ($request) {
            $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
            $role->syncPermissions($request->selectedPermissions);
        });


        return to_route('settings.role_and_permissions');
    }
}

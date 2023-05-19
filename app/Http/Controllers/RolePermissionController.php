<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
     public function index(){
         return inertia('Settings/RolePermission',[
            'roles' => Role::all()
         ]);
     }

     public function create(){
         return inertia("Settings/CreateRole",[
                'permissions' => Permission::all()
         ]);
     }

     public function store(Request $request){
         $request->validate([
            'name' => 'required',
            'selectedPermissions' => 'required'
         ]);

         app()['cache']->forget('spatie.permission.cache');

         DB::transaction(function() use ($request){
            $role = Role::create(['name' => $request->name, 'guard_name' => 'web' ]);
            $role->syncPermissions($request->selectedPermissions);
         });


         return to_route('settings.role_and_permissions');
     }
}

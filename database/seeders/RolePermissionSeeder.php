<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $permission1 = Permission::create(['name'=>'create users']);
          $permission2 = Permission::create(['name'=>'view users']);
          $permission3 = Permission::create(['name'=>'delete users']);
          $permission4 = Permission::create(['name'=>'edit users']);


          $permission5 = Permission::create(['name'=>'create visits']);
          $permission6 = Permission::create(['name'=>'view visits']);
          $permission7 = Permission::create(['name'=>'delete visits']);
          $permission8 = Permission::create(['name'=>'edit visits']);


          $permission9 = Permission::create(['name'=>'view settings']);
          $permission10 = Permission::create(['name'=>'edit settings']);
          $permission11 = Permission::create(['name'=>'delete settings']);
          $permission12 = Permission::create(['name'=>'create settings']);



          $permission13 = Permission::create(['name'=>'view partners']);
          $permission14 = Permission::create(['name'=>'edit partners']);
          $permission15 = Permission::create(['name'=>'delete partners']);
          $permission16 = Permission::create(['name'=>'create partners']);



          $role = Role::create(['name' => 'Super-Admin']);
          $role = Role::create(['name' => 'audit']);
          $role = Role::create(['name' => 'IT']);



    }
}

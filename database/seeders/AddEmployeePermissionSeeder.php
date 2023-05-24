<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class AddEmployeePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission1 = Permission::create(['name'=>'create employees']);
        $permission2 = Permission::create(['name'=>'view employees']);
        $permission3 = Permission::create(['name'=>'delete employees']);
        $permission4 = Permission::create(['name'=>'edit employees']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Super-Admin',
            'email' => 'admin@gnpc.gm1',
            'userable_type' => 'App\New',
            'userable_id' => 1,
            'password' => Hash::make('secret')
        ]);
        $user->assignRole('Super-Admin');


        $user2 = User::create([
            'name' => 'IT-Admin',
            'email' => 'it@gnpc.gm1',
            'userable_type' => 'App\New',
            'userable_id' => 1,
            'password' => Hash::make('secret')
        ]);
        $user2->assignRole('IT');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class AssignedUserRoleController extends Controller
{
    public function index(Request $request, User $user)
    {
        $request->validate([
            'updated_roles' => 'required'
        ]);
        $roles = $request->updated_roles;

        $filteredArray = array_filter($roles, function ($item) {
            return $item['assigned'] === true;
        });


        $names = array_column($filteredArray, 'name');

        $user->syncRoles($names);
        return to_route('users.index');
    }
}

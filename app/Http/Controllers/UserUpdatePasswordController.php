<?php

namespace App\Http\Controllers;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserUpdatePasswordController extends Controller
{
    use PasswordValidationRules;


    public function index(User $user)
    {
        return inertia('Users/ChangePassword', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'password' => $this->passwordRules()
        ]);
        $user->update([
            'password' => Hash::make($request['password']),
        ]);
    }
}

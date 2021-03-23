<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
/**
 * Create a new user instance after a valid registration.
 *
 * @param  array  $data
 * @return User
 */
    protected function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
        ]);
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        if (User::where('email', '=', $request->get('email'))->exists()) {
            return response()->json([
                'status_code' => 401,
                'message' => 'Email was existed',
            ]);
            }
            $user->password = Hash::make($request->get('password'));
            $user->save();
            Auth::login($user);
            return response()->json([
            'status_code' => 200,
            'message' => 'success',
            ]);
    }
}

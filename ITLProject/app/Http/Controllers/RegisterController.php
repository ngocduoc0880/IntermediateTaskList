<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


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
                'email' => 'required|email|max:255',
                'password' => 'required|min:6|confirmed',
            ]);
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->remember_token = Str::random(60);
            if (User::where('email', '=', $request->get('email'))->exists()) {
                return back()->withErrors([
                    'email' => 'Email was existed',
                ]);
             }
             $user->password = Hash::make($request->get('password'));
             $user->save();
             Auth::login($user);
             return redirect()->to('index');
        }
}

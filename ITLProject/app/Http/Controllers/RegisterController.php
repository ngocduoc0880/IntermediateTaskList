<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            $user = User::create(request(['name', 'email','password']));
//        auth()->login($user);
        return redirect()->to('dashboard');
        }
}

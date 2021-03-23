<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required|'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            throw new UnauthorizedException();
        }
        $user = User::where('email', $request->email)->first();
        $tokenResult = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
        ]);
    }
}

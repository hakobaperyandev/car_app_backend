<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('app-token')->plainTextToken;
        return [
            'message' => 'User logged in successfully', 
            'token'   => $token,
            'user'    => $user,
            'isAdmin' => $user->role === User::ROLE_ADMIN 
        ];

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'  => true,
            'message' => 'Logged out'
        ]);
    }
}

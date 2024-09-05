<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|in:admin,approver'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $user = User::create($validateData);

        return response()->json([
            'user' => $user,
            'message' => 'User registered successfully'
        ]);
    }


    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            if (!$token = JWTAuth::attempt($validateData)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid credentials'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not create token'
            ], 500);
        }

        $user = auth()->user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'name' => $user->name,
                'role' => $user->role
            ]
        ]);
    }


    public function logout(Request $request)
{
    try {
        // Invalidate the token
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    } catch (JWTException $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to log out'
        ], 500);
    }
}

}

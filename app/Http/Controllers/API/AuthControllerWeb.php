<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthControllerWeb extends Controller
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

        // Redirect to the login page after successful registration
        return Redirect::route('login')->with('success', 'User registered successfully. Please log in.');
    }

    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            if (!$token = JWTAuth::attempt($validateData)) {
                return Redirect::back()->withErrors(['error' => 'Invalid credentials']);
            }
        } catch (JWTException $e) {
            return Redirect::back()->withErrors(['error' => 'Could not create token']);
        }

        $user = auth()->user();

        // Create a session for the user if needed

        // Redirect to the dashboard page after successful login
        return Redirect::route('dashboard')->with('success', 'Logged in successfully');
    }

    public function logout(Request $request)
    {
        try {
            // Invalidate the token
            JWTAuth::invalidate(JWTAuth::getToken());

            return Redirect::route('home')->with('success', 'Logged out successfully');
        } catch (JWTException $e) {
            return Redirect::route('home')->withErrors(['error' => 'Failed to log out']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // login user
    public function login(Request $request)
    {
        // validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attempt login
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        // generate token
        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        // return response
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    // logout user
    public function logout(Request $request)
    {
        // revoke token
        auth()->user()->tokens()->delete();

        // return response
        return response()->json([
            'message' => 'Logged out'
        ]);
    }

    // register user
    public function register(Request $request)
    {
        // validate request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password_confirmation' => 'required|same:password',
            'password' => 'required'
        ]);

        // create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password_confirmation' => $request->password_confirmation,
            'password' => bcrypt($request->password)
        ]);

        // generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        // return response
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    // get authenticated user
    public function user(Request $request)
    {
        // return response
        return response()->json([
            'user' => $request->user()
        ]);
    }
}

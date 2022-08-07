<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'email' => ['required', 'unique'],
            'password' => ['required', 'min:8', 'max:15']
        ]);
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['status_code' => 200, 'User Data' => $user, 'token' => 'Bearer ' . $token]);

    }

    public function login(Request $request)
    {

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {

            return response()->json(['status_code' => 401, 'message' => 'Email Or Password Doesnt Match']);

        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json(
            ['status_code' => 200, 'User Data' => $user, 'token' => 'Bearer ' . $token]
        );
    }
}

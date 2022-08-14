<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ];
        $user =  User::create($data);

        if ($user) {
            return response()->json("Registration Successful");
        }

        return response()->sjon("Something went wrong", 500);
    }

    public function login(Request $request)
    {
        if (Auth::guard()->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return response()->json("Login Success", 200);
        }
        return response()->json('Invalid credentials', 500);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
    }
}

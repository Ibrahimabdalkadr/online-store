<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends ApiController
{

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|min:6',
            ]);
            $credentials = $request->only('email', 'password');
            if (!$token = auth()->attempt($credentials)) {
                return $this->errorResponse('auth failed', [], 401);
            }
            $user = $request->user();
            return $this->successResponse('success', ['token' => $token, 'user' => $user]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return $this->successResponse('User created successfully', [
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        return $this->successResponse('User created successfully', [
            'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return $this->successResponse('User created successfully', [
            'user' => Auth::user(),
            'token' => Auth::refresh(),
        ]);
    }



}

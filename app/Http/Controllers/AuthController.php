<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

class AuthController extends ApiController
{

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string|min:6',
            ]);

            if($validator->fails()) return $this->errorResponse('Validation Error.', $validator->errors(),Response::HTTP_BAD_REQUEST);


            $credentials = $request->only('email', 'password');

            $authenticated =  Auth::attempt($credentials);
            if(!$authenticated) return $this->errorResponse('email of password not is invalid', $validator->errors(),Response::HTTP_BAD_REQUEST);

            $user = Auth::user();
            $success['token'] = $user->createToken('access-token')->plainTextToken;
            $success['user'] = $user;
            return $this->successResponse('success', $success);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if($validator->fails()){
                return $this->errorResponse('Validation Error.', $validator->errors(),Response::HTTP_BAD_REQUEST);
            }

            $input = $request->all();
            $input['password'] = Hash::make($request->password);
            $user = User::create($input);
            $success['token'] =  $user->createToken('access-token')->plainTextToken;
            $success['user'] =  $user;
            return $this->successResponse('User created successfully', [
                $success,
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

}

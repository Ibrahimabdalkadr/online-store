<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends ApiController
{

    public function index(Request $request)
    {
        try {
            $PageNo = $request->get('page_no', 1);
            $pageSize = $request->get('page_size', 15);
            $result = User::paginate($pageSize, ['*'], 'page', $PageNo);
            return $this->successResponse(
                '',
                [
                    'users' => $result->items(),
                    'total' => $result->total()
                ]
            );
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if ($validator->fails())
                return $this->errorResponse('validation', $validator->errors(), 400);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return $this->successResponse('created', ['user' => $user]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $user = User::where('id', $id)->first();
            return $this->successResponse('', ['user' => $user ?? 'user not found']);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'string',
                'email' => 'email',
            ]);
            if ($validator->fails())
                return $this->errorResponse('validation', $validator->errors(), 400);
            $data = $validator->validated();
            $user->update($data);
            return $this->successResponse('updated', ['user' => $user ?? 'user not found']);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
    public function favorite(Request $request)
    {
        try {
            $PageNo = $request->get('page_no', 1);
            $pageSize = $request->get('page_size', 15);
            $result = $request->user()->favoriteProducts()->paginate($pageSize, ['*'], 'page', $PageNo);
            return $this->successResponse('', [
                'favoriteProducts'=> $result->items(),
                'total' => $result->total()
                ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            $user = User::destroy($id);
            return $this->successResponse('deleted', []);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}

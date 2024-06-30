<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends ApiController
{

    public function index()
    {
        try {
            $categories = Category::all();
            return $this->successResponse('', ['categories' => $categories]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'icon' => 'required|file|mimes:svg|max:2048',
            ]);
            if ($validator->fails())
                return $this->errorResponse('validation', $validator->errors(), 400);

            $file = $request->file('icon')->store('category', 'category_imgs');
            $category = Category::create(
                [
                    'name' => $request->input('name'),
                    'icon' => asset('app/public/' . $file),
                ]
            );
            return $this->successResponse(
                'created',
                [
                    'category' => $category
                ]
            );
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


    public function update(Request $request, Category $category)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'string|required',
            ]);
            if ($validator->fails())
                return $this->errorResponse('validation', $validator->errors(), 400);
            $category->update(['name' => $request->name]);
            return $this->successResponse('updated', ['category' => $category]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

    }

    public function destroy($id)
    {
        try {
            $user = Category::destroy($id);
            return $this->successResponse('deleted');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}

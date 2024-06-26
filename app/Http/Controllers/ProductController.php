<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends ApiController
{
    public function store(Request $request)
    {
        try {
            $validator = validator::make($request->all(), [
                'name' => 'required|string',
                'image' => 'required|file|mimes:jpeg,png|max:2048',
                'description' => 'string|min:0|max:500',
                'price' => 'required|numeric',
                'category_id' => 'required|numeric',
            ]);
            if ($validator->fails())
                return $this->errorResponse('validation', $validator->errors(), 400);
            $category = Category::where('id', $request->input('category_id'))->first();
            $file = $request->file('image')->store($category->name, 'product_imgs');
            $product = Product::create(
                [
                    'name' => $request->input('name'),
                    'image' => asset('app/public/product/' . $file),
                    'description' => $request->input('description'),
                    'price' => (float) $request->input('price'),
                    'category_id' => (float) $request->input('category_id'),
                ]
            );
            return $this->successResponse(
                'created',
                [
                    'product' => $product
                ]
            );
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


    public function show(Request $request, $category_id)
    {
        try {
            $category = Category::findOrFail($category_id);
            $data = $request->all();
            $result = $category->products()->paginate($data['pageSize'] ?? 15, '*', 'page', $data['pageNo'] ?? 1);
            return $this->successResponse('', [
                'products' => $result->items(),
                'total' => $result->total()
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


    public function update(Request $request, Product $product)
    {
        try {
            $validator = validator::make($request->all(), [
                'name' => 'string',
                'description' => 'string|min:0|max:500',
                'price' => 'numeric',
                'category_id' => 'numeric',
            ]);
            if ($validator->fails())
                return $this->errorResponse('validation', $validator->errors(), 400);
            $data = $validator->validated();
            $product->update($data);
            return $this->successResponse(
                'created',
                [
                    'product' => $product
                ]
            );
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = Product::destroy($id);
            return $this->successResponse('deleted');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}

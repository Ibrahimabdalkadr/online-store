<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends ApiController
{

    public function index(Request $request)
    {
        $category_id = $request->get('category_id');
        $featured = $request->get('featured');
        $page = $request->get('page') ?? 1;
        $perPage = $request->get('perPage') ?? 15;
        try {
            if (!$category_id) {
                $result = Product::with('category')->where('featured', $featured)->paginate($perPage, ['*'], 'page', $page);
                return $this->successResponse('', ['products' => $result->items(), 'total' => $result->total()]);
            }
            $categories = Category::findOrFail($category_id);
            $products = $categories->with('product');
            return $this->successResponse('', ['products' => $products]);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
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


    public function show(Request $request, Product $product)
    {
        try {
            return $this->successResponse('', [
                'product' => $product,
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

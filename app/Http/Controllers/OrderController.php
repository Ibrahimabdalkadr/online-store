<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class OrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'products_id' => ['required','array'],
            ]);

            if ($validator->fails())
                return $this->errorResponse('validation', $validator->errors(), 400);

            $newOrder = Order::create([
                'user_id' => Auth::id(),
            ]);

            foreach ($request->products_id as  $product) {
                $newOrder->products()->attach($product);
            }
            $newOrder->save();

            return  $this->successResponse('',  ['order' => $newOrder]);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(),[],$e->getCode());
        }
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, Order $id)
    {
        try {
            $order = Order::where('id', $id)->first();

            return  $this->successResponse('',['order' => $data ]);
        }catch (\Exception $e){
            return $this->errorResponse($e->getMessage(),[],$e->getCode());
        }
    }
    public function destroy(Order $order)
    {
        try {
            if($order->user()->id !== Auth::user()->id) return  $this->errorResponse('the order to another user',[],Response::HTTP_BAD_REQUEST);
            $order->delete();
            return  $this->successResponse('the order deleted successfully');
        } catch (\Exception $e){
            return $this->errorResponse($e->getMessage(),[],$e->getCode());
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected JsonResponse $apiResponse;

    // public function __construct()
    // {
    //     app()->setLocale(request()->header('Accept-Language') ?? default_lang());
    // }

    protected function successResponse($message = null, $data = [], $code = 200)
    {
        return response()->json([
            'error' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function errorResponse($message = null, $data = [], $code = 500)
    {
        return response()->json([
            'error' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
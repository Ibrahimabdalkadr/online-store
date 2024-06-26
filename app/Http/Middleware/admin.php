<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Http\Controllers\ApiController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class admin extends ApiController
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role == RoleEnum::ADMIN->value) {
            return $next($request);
        }
        return $this->errorResponse('unauthorized', [],Response::HTTP_UNAUTHORIZED);
    }
}

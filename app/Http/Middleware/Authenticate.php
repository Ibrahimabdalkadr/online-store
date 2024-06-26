<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends ApiController
{

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->expectsJson()) {
            return $next($request);
        }
        return $this->errorResponse('unsupported_method', [],response::HTTP_METHOD_NOT_ALLOWED);
    }
}

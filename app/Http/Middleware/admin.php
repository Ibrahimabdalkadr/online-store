<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Http\Controllers\ApiController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class admin extends ApiController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user->role == RoleEnum::ADMIN->value){
            return $next($request);
        }
        return $this->errorResponse('unauthorized', [],Response::HTTP_UNAUTHORIZED);
    }
}

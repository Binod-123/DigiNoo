<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check for the static token in the Authorization header
        if ($request->header('Authorization') !== 'Bearer '. env('STATIC_API_TOKEN')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

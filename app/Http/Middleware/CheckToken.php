<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('auth_token');
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}

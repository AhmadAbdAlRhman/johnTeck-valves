<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class CheckToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');

        if (!$token || !Str::startsWith($token, 'Bearer ')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Remove "Bearer " prefix to get the actual token
        $token = Str::replaceFirst('Bearer ', '', $token);

        // Validate the token here if needed

        return $next($request);
    }
}

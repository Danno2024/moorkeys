<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json([
                'success' => false,
                'error' => 'Missing API token. Provide a Bearer token in the Authorization header.',
                'code' => 'MISSING_TOKEN',
            ], 401);
        }

        $user = User::where('api_token', hash('sha256', $token))->where('is_active', true)->first();

        if (! $user) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid or inactive API token.',
                'code' => 'INVALID_TOKEN',
            ], 401);
        }

        $request->merge(['api_user' => $user]);

        return $next($request);
    }
}

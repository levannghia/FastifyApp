<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTokens
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $user = $request->user();

        // Kiểm tra xem refresh token có hết hạn không
        if ($user->refresh_token_expiry && $user->refresh_token_expiry < now()) {
            $user->tokens()->delete();
            return response()->json(['message' => 'Refresh token has expired. Please log in again.'], 401);
        }

        return $next($request);
    }
}

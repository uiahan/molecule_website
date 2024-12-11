<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckValidToken
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Memastikan token valid dan hanya dipakai oleh satu perangkat
        if ($user->current_device_token !== $request->bearerToken()) {
            // Jika token tidak cocok dengan token yang terdaftar untuk perangkat ini
            return response()->json(['message' => 'Token tidak valid atau sudah dipakai di perangkat lain.'], 401);
        }

        return $next($request);
    }
}

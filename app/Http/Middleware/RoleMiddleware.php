<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::guard('account')->check()) {
            return redirect()->route('login');
        }

        $user = Auth::guard('account')->user();

        if ($user->role !== $role) {
            abort(403, 'Anda tidak punya akses.');
        }

        return $next($request);
    }
}

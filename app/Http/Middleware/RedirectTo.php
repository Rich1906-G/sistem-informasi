<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectTo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::guard('account')->check()) {
            $role = Auth::guard('account')->user()->role;

            switch ($role) {
                case 'Admin':
                    return redirect()->route('admin.dashboard');
                case 'Prodi':
                    return redirect()->route('prodi.dashboard');
                case 'Mahasiswa':
                    abort(403, 'Udah Login Kau Lek');
            }
        } elseif (!Auth::guard('account')->check()) {
            return redirect()->route('login.mahasiswa');
        }
        return $next($request);
    }
}

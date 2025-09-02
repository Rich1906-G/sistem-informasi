<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        if (Auth::guard('account')->check()) {
            $role = Auth::guard('account')->user()->role;

            switch ($role) {
                case 'Admin':
                    return redirect()->route('admin.dashboard');
                case 'Prodi':
                    return redirect()->route('prodi.dashboard');
                case 'Mahasiswa':
                    return redirect()->route('mahasiswa.dashboard');
            }
        }

        return $next($request);
    }
}

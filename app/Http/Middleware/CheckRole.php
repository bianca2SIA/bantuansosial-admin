<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika belum login → redirect
        if (!Auth::check()) {
            return redirect()->route('auth');
        }

        // Ambil role user yang sedang login
        $userRole = Auth::user()->role;

        // Jika role user TIDAK ADA dalam daftar role yang diizinkan
        if (!in_array($userRole, $roles)) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}

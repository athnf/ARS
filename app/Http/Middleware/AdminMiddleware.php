<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pengecekan krusial:
        // 1. Pastikan user sudah login (Auth::check())
        // 2. Pastikan user memiliki role 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // Lanjut ke halaman Admin
        }

        // Jika tidak berhak, redirect ke halaman utama atau tampilkan error 403
        abort(403, 'Akses Ditolak. Anda bukan Admin.');
    }
}
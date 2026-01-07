<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Cek apakah user login
        if (! $request->user()) {
            return redirect()->route('login');
        }

        // 2. Cek apakah role user SESUAI dengan parameter yg diminta
        if ($request->user()->role !== $role) {
            // Jika Admin coba akses halaman Student, atau sebaliknya -> 403 Forbidden
            abort(403, 'ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI.');
        }

        return $next($request);
    }
}

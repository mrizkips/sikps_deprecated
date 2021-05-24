<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.beranda');
        } else if (Auth::guard('mahasiswa')->check()) {
            return redirect()->route('mahasiswa.beranda');
        } else if (Auth::guard('dosen')->check()) {
            return redirect()->route('dosen.beranda');
        }

        return $next($request);
    }
}

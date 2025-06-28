<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request; // ← tambahkan ini
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
{
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        return redirect('/login');
    }
    return $next($request);
}

}

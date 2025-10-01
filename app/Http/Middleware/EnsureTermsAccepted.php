<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureTermsAccepted
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && is_null(Auth::user()->accepted_at)) {
            return redirect()->route('terms.show');
        }

        return $next($request);
    }
}

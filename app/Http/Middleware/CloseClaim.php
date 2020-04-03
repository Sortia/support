<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CloseClaim
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->isManager()) {
            return $next($request);
        }

        return back();
    }
}

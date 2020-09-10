<?php

namespace App\Http\Middleware;

use Closure;

class CheckComing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (checkComingSoon() == 1) {
            return redirect()->route('comingsoon');
        }
        return $next($request);
    }
}

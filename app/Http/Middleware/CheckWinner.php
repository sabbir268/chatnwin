<?php

namespace App\Http\Middleware;

use Closure;

class CheckWinner
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
        if (auth()->check()) {
            if (auth()->user()->role == 1) {
                if (isWinner(auth()->user()->id)) {
                    return redirect('/result');
                }
            }
        }
        return $next($request);
    }
}

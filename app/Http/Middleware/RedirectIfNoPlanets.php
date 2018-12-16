<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNoPlanets
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!auth($guard)->user()->homePlanet()) {
            return redirect()->route('ruler.create');
        }

        return $next($request);
    }
}

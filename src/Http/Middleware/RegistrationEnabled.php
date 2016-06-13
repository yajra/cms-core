<?php

namespace Yajra\CMS\Http\Middleware;

use Closure;

class RegistrationEnabled
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
        if (config('site.registration')) {
            abort(403, 'Registration is not allowed');
        }

        return $next($request);
    }
}

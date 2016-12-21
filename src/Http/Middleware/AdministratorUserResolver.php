<?php

namespace Yajra\CMS\Http\Middleware;

use Closure;

class AdministratorUserResolver
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
        $prefix = admin_prefix();

        if ($request->is("$prefix/*") || $request->is($prefix)) {
            config()->set('auth.defaults.guard', 'administrator');
        }

        return $next($request);
    }
}

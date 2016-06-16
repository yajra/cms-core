<?php

namespace Yajra\CMS\Http\Middleware;

use Closure;

class ThemeChanger
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
        $response = $next($request);
        if ($request->query('tmpl')) {
            config()->set('theme.frontend', $request->query('tmpl'));
        }

        return $response;
    }
}

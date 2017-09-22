<?php

namespace Yajra\CMS\Http\Middleware;

use Closure;
use Yajra\CMS\Themes\Facades\Theme;

class AdministratorThemeResolver
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
            $theme = config('themes.backend', 'admin-lte');

            Theme::use($theme, $frontend = false);
        }

        return $next($request);
    }
}

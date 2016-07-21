<?php

namespace Yajra\CMS\Http\Middleware;

use Closure;

class ThemeChanger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->query('cms_theme')) {
            $finder   = app('themes.view.finder');
            $basePath = config('theme.path', base_path('themes')) . DIRECTORY_SEPARATOR . $request->query('cms_theme');
            $finder->setBasePath($basePath);
        }

        return $next($request);
    }
}

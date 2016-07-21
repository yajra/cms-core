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
        if ($theme = $request->query('cms-theme')) {
            $finder   = app('themes.view.finder');
            $basePath = config('themes.path.frontend', base_path('themes/frontend'));
            $finder->removeBasePath();
            $finder->setBasePath($basePath . DIRECTORY_SEPARATOR . $theme);

            config(['themes.frontend' => $theme]);
        }

        return $next($request);
    }
}

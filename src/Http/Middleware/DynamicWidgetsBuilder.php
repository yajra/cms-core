<?php

namespace Yajra\CMS\Http\Middleware;

use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Yajra\CMS\Entities\Widget;

class DynamicWidgetsBuilder
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
        // skip dynamic widgets on administrator pages.
        if ($request->is('administrator/*') || $request->is('administrator')) {
            return $next($request);
        }

        try {
            $factory = app('arrilot.widget-group-collection');
            $this->getWidgets()->each(function (Collection $group) use ($factory) {
                $group->each(function (Widget $widget) use ($factory) {
                    $displayWidget = true;

                    if ($widget->requiresAuthentication() && ! auth()->check()) {
                        $displayWidget = false;
                    }

                    if (count($widget->permissions)) {
                        if ($widget->authorization === 'can') {
                            foreach ($widget->permissions as $permission) {
                                if (auth()->guest() ||
                                    (auth()->check() && ! auth()->user()->can($permission->slug))
                                ) {
                                    $displayWidget = false;
                                    continue;
                                }
                            }
                        } else {
                            if (auth()->guest() ||
                                (auth()->check() && ! auth()
                                        ->user()
                                        ->canAtLeast($widget->permissions->pluck('slug')->toArray()))
                            ) {
                                $displayWidget = false;
                            }
                        }
                    }

                    if ($displayWidget) {
                        $factory->group($widget->position)
                                ->addWidget($widget->present()->class(), [], $widget);
                    }
                });
            });
        } catch (QueryException $e) {
            // \\_(",)_//
        }

        return $next($request);
    }

    /**
     * Get all published widgets.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getWidgets()
    {
        $widgets = Widget::with('permissions')->published()->get();

        return $widgets->groupBy('position')->sortBy('order');
    }
}

<?php

namespace Yajra\CMS\Http\Middleware;

use Yajra\CMS\Entities\Widget;
use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

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
        try {
            /** @var Collection $widgets */
            $widgets = Widget::with('permissions')->published()->get();
            $factory = app('arrilot.widget-group-collection');
            $widgets->groupBy('position')
                    ->sortBy('order')
                    ->each(function (Collection $group) use ($factory) {
                        $group->each(function (Widget $widget) use ($factory) {
                            $displayWidget = true;

                            if ($widget->requiresAuthentication() && ! auth()->check()) {
                                $displayWidget = false;
                            }

                            if ($widget->permissions->count()) {
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
                                        ->addWidget($widget->present()->type, [], $widget);
                            }
                        });
                    });
        } catch (QueryException $e) {
            // \\_(",)_//
        }

        return $next($request);
    }
}

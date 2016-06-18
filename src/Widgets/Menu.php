<?php

namespace Yajra\CMS\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Yajra\CMS\Entities\Navigation;

class Menu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     *
     * @param \Yajra\CMS\Entities\Widget $widget
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run($widget)
    {
        $navigation = app('navigation')->findOrFail($widget->param('navigation_id'));

        if (! $navigation->menus()->count()) {
            return ''; // return empty string if navigation does not have menu items
        }

        return view($widget->present()->template(), [
            'config' => $this->config,
            'widget' => $widget,
            'menu'   => 'menu_' . $navigation->type,
        ]);
    }
}

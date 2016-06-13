<?php

namespace Yajra\CMS\Widgets;

use Arrilot\Widgets\AbstractWidget;

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
        return view($widget->present()->template(), [
            'config' => $this->config,
            'widget' => $widget,
            'menu'   => 'menu_' . $widget->parameter,
        ]);
    }
}

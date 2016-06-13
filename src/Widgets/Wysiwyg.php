<?php

namespace Yajra\CMS\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Wysiwyg extends AbstractWidget
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
     * @throws \Laracasts\Presenter\Exceptions\PresenterException
     */
    public function run($widget)
    {
        return view($widget->present()->template(), [
            'config' => $this->config,
            'widget' => $widget,
        ]);
    }
}

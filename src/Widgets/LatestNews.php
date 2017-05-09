<?php

namespace Yajra\CMS\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Yajra\CMS\Entities\Category;

class LatestNews extends AbstractWidget
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
        $category = Category::findOrNew($widget->param('category_id'));
        $articles = $category->articles()->latest()->take((int) $widget->param('limit') ?: 5)->get();

        return view($widget->present()->template(), [
            'config'   => $this->config,
            'widget'   => $widget,
            'category' => $category,
            'articles' => $articles,
        ]);
    }
}

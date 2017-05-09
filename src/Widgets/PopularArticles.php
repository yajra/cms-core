<?php

namespace Yajra\CMS\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Yajra\CMS\Entities\Article;
use Yajra\CMS\Entities\Category;

class PopularArticles extends AbstractWidget
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
        $category  = Category::query()->findOrNew($widget->param('category_id'));
        $limit     = (int) $widget->param('limit') ?: 5;
        $direction = 'desc';
        if ($category->exists) {
            $articles = $category->articles()->orderBy('hits', $direction)->take($limit)->get();
        } else {
            $articles = Article::query()->orderBy('hits', $direction)->take($limit)->get();
        }

        return view($widget->present()->template(), [
            'config'   => $this->config,
            'widget'   => $widget,
            'category' => $category,
            'articles' => $articles,
        ]);
    }
}

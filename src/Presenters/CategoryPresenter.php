<?php

namespace Yajra\CMS\Presenters;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Laracasts\Presenter\Presenter;
use Yajra\CMS\Entities\Category;

class CategoryPresenter extends Presenter
{
    /**
     * Indented title against depth.
     *
     * @param int $pad
     * @return string
     */
    public function indentedTitle($pad = 1)
    {
        return str_repeat('— ', $this->entity->depth - $pad) . $this->entity->title;
    }

    /**
     * Slash separated sub-categories.
     *
     * @return string
     */
    public function name()
    {
        /** @var \Illuminate\Support\Collection $c */
        $c = $this->entity->getAncestorsAndSelfWithoutRoot();

        return $c->implode('title', ' / ');
    }

    /**
     * Category's slug.
     *
     * @return string
     */
    public function slug()
    {
        return $this->alias();
    }

    /**
     * Get the nested alias on the category.
     *
     * @return string
     */
    public function alias()
    {
        return $this->entity->getAncestorsAndSelfWithoutRoot()->implode('alias', '/');
    }

    /**
     * Display nested categories of the article.
     *
     * @return \Illuminate\Support\HtmlString
     */
    public function slugList()
    {
        $categories = explode('/', $this->alias());
        $html       = [];

        foreach ($categories as $category) {
            $html[] = new HtmlString('<span class="label label-info">' . e(Str::title($category)) . '</span>&nbsp;');
        }

        return new HtmlString(implode('', $html));
    }
}

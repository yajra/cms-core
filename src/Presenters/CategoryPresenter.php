<?php

namespace Yajra\CMS\Presenters;

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
     * Get the nested alias on the category.
     *
     * @return string
     */
    public function alias()
    {
        $alias = [];
        $this->entity->getAncestorsAndSelfWithoutRoot()->each(function (Category $cat) use (&$alias) {
            $alias[] = $cat->alias;
        });

        return implode('/', $alias);
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
}

<?php

namespace Yajra\CMS\Presenters;

use Yajra\CMS\Entities\Article;
use Yajra\CMS\Entities\Category;
use Laracasts\Presenter\Presenter;
use Yajra\CMS\Entities\Extension;

class MenuPresenter extends Presenter
{
    /**
     * Link href target window.
     *
     * @return string
     */
    public function target()
    {
        return $this->entity->target == 0 ? '_self' : '_blank';
    }

    /**
     * Indented title against depth.
     *
     * @param int $start
     * @param string $symbol
     * @return string
     */
    public function indentedTitle($start = 1, $symbol = '— ')
    {
        return str_repeat($symbol, $this->entity->depth - $start) . ' ' . $this->entity->title;
    }

    /**
     * Generate menu url depending on type the menu.
     *
     * @return string
     */
    public function url()
    {
        switch ($this->entity->extension->id) {
            case Extension::MENU_ARTICLE:
                $article = Article::query()->findOrFail($this->entity->param('article_id', 0));

                return $article->alias ?? '';

            case Extension::MENU_CATEGORY_LIST:
                $category   = $this->entity->param('category_id', 0);
                $categoryId = explode(':', $category)[0];

                $category = Category::query()->findOrFail($categoryId);

                return 'category/' . $category->alias;

            case Extension::MENU_CATEGORY_BLOG:
                $category   = $this->entity->param('category_id', 0);
                $categoryId = explode(':', $category)[0];

                $category = Category::query()->findOrFail($categoryId);

                return 'category/' . $category->alias . '/blog';

            default:
                return $this->entity->url;
        }
    }
}

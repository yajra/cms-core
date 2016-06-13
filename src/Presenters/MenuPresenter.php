<?php

namespace Yajra\CMS\Presenters;

use Yajra\CMS\Entities\Article;
use Yajra\CMS\Entities\Category;
use Laracasts\Presenter\Presenter;

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
        switch ($this->entity->type) {
            case 'article.single':
                $article = Article::find($this->entity->fluentParameters()->get('article_id', 0));

                return $article->alias ?? '';

            case 'article.category':
                $category   = $this->entity->fluentParameters()->get('category_id', 0);
                $categoryId = explode(':', $category)[0];

                $category = Category::findOrNew($categoryId);

                return $category->alias ? 'category/' . $category->alias : '';

            default:
                return $this->entity->url;
        }
    }
}
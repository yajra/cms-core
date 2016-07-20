<?php

namespace Yajra\CMS\Events;

use Yajra\CMS\Entities\Article;

class ArticleWasViewed extends Event
{
    /**
     * @var \Yajra\CMS\Entities\Article
     */
    public $article;

    /**
     * ArticleWasViewed constructor.
     *
     * @param \Yajra\CMS\Entities\Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
}

<?php

namespace Yajra\CMS\Events\Articles;

use Yajra\CMS\Entities\Article;
use Yajra\CMS\Events\Event;

class ArticleWasUpdated extends Event
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

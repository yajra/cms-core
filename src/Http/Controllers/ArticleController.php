<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\CMS\Entities\Article;
use Yajra\CMS\Events\ArticleWasViewed;

class ArticleController extends Controller
{
    /**
     * Display an article.
     *
     * @param \Yajra\CMS\Entities\Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Article $article)
    {
        $article->increment('hits');
        event(new ArticleWasViewed($article));

        return view('article.show', compact('article'));
    }
}

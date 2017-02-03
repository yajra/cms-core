<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\CMS\Entities\Article;
use Yajra\CMS\Events\Articles\ArticleWasViewed;

class ArticleController extends Controller
{
    /**
     * Display an article.
     *
     * @param \Yajra\CMS\Entities\Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Article $article, Request $request)
    {
        $article->increment('hits');
        $template = $request->get('tmpl', 'master');

        event(new ArticleWasViewed($article));

        return view('article.show', compact('article', 'template'));
    }
}

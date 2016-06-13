<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\Entities\Article;
use App\Http\Controllers\Controller;
use App\Http\Requests;

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

        return view('article.show', compact('article'));
    }
}

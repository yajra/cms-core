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
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        /** @var Article $article */
        $article = Article::query()->findOrFail($id);
        $article->visited();

        $template = $request->get('tmpl', 'master');

        event(new ArticleWasViewed($article));

        return view($article->getTemplate(), compact('article', 'template'));
    }
}

<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\Entities\Article;

class TagsController extends Controller
{
    public function show($slug)
    {
        $limit    = request()->get('limit', 10);
        $articles = Article::query()->whereHas('tagged', function ($query) use ($slug) {
            $query->where('tag_slug', $slug);
        })->paginate($limit);

        $path = null;
        if (request()->filled('limit')) {
            $path .= '&limit=' . $limit;
            $articles->setPath($path);
        }

        return view("tags.show", compact('slug', 'articles', 'limit'));
    }
}

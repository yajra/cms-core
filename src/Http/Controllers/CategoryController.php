<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\CMS\Entities\Category;
use Yajra\CMS\Events\CategoryWasViewed;

class CategoryController extends Controller
{
    /**
     * Display an article.
     *
     * @param \Yajra\CMS\Entities\Category $category
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category, Request $request)
    {
        $category->increment('hits');

        $layout   = $request->query('layout', 'blog');
        $limit    = $request->get('limit', $layout == 'list' ? 10 : 5);
        $articles = $category->articles()->isNotPage()->latest()->simplePaginate($limit);

        $path = null;
        if ($layout === 'list') {
            $path .= '?layout=list';
            $articles->setPath($path);
        }

        if ($request->has('limit')) {
            $path .= '&limit=' . $limit;
            $articles->setPath($path);
        }

        event(new CategoryWasViewed($category));

        return view("category.$layout", compact('category', 'articles', 'limit'));
    }
}

<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Yajra\CMS\Entities\Category;

class CategoryController extends Controller
{
    /**
     * Display an article.
     *
     * @param \Yajra\CMS\Entities\Category $category
     * @param \Illuminate\Http\Request $request
     * @param string $layout
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category, Request $request, $layout = 'list')
    {
        $category->increment('hits');

        $limit    = $request->get('limit', $layout == 'list' ? 10 : 5);
        $articles = $category->articles()->paginate($limit);

        if ($request->has('limit')) {
            $articles->setPath('?limit=' . $limit);
        }

        return view('category.' . $layout, compact('category', 'articles', 'limit'));
    }
}

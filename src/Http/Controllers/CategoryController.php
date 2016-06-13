<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\Entities\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

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
        $limit    = $request->get('limit', 10);
        $articles = $category->articles()->paginate($limit);
        $articles->setPath($category->alias . '?limit=' . $limit);

        return view('category.show', compact('category', 'articles', 'limit'));
    }
}

<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\CMS\Search\SearchManager;

class SearchController extends Controller
{
    /**
     * @var \Yajra\CMS\Search\SearchManager
     */
    protected $engine;

    /**
     * SearchController constructor.
     *
     * @param \Yajra\CMS\Search\SearchManager $engine
     */
    public function __construct(SearchManager $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Display search results.
     *
     * @param  string $keyword
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $keyword  = request('q');
        $articles = [];

        if ($keyword) {
            $articles = $this->engine->search($keyword, 10);
        }

        return view('search.show', compact('articles', 'keyword'));
    }
}

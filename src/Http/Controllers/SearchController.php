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
        $limit    = abs(request('limit', config('site.limit', 10)));

        $max_limit = config('site.max_limit', 100);
        if ($limit > $max_limit) {
            $limit = $max_limit;
        }

        if ($keyword) {
            $articles = $this->engine->search($keyword, $limit);
            $articles->appends('q', $keyword);
            $articles->appends('limit', $limit);
        }

        return view('search.show', compact('articles', 'keyword'));
    }
}

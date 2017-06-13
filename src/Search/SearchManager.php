<?php

namespace Yajra\CMS\Search;

use Yajra\CMS\Contracts\SearchEngine;

class SearchManager implements SearchEngine
{
    /**
     * @var \Yajra\CMS\Contracts\SearchEngine
     */
    protected $searchEngine;

    /**
     * SearchManager constructor.
     *
     * @param \Yajra\CMS\Contracts\SearchEngine $searchEngine
     */
    public function __construct(SearchEngine $searchEngine)
    {
        $this->searchEngine = $searchEngine;
    }

    /**
     * @param string $keyword
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($keyword, $limit = 10)
    {
        return $this->searchEngine->search($keyword, $limit);
    }

    /**
     * @param \Yajra\CMS\Contracts\SearchEngine $engine
     * @return $this
     */
    public function setEngine(SearchEngine $engine)
    {
        $this->searchEngine = $engine;

        return $this;
    }

    /**
     * @return \Yajra\CMS\Contracts\SearchEngine
     */
    public function getEngine()
    {
        return $this->searchEngine;
    }
}

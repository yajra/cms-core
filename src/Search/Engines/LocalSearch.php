<?php

namespace Yajra\CMS\Search\Engines;

use Illuminate\Database\Eloquent\Builder;
use Yajra\CMS\Contracts\SearchEngine;
use Yajra\CMS\Entities\Article;

class LocalSearch implements SearchEngine
{
    /**
     * @param string $keyword
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($keyword, $limit = 10)
    {
        return Article::query()
                      ->with('category')
                      ->whereRaw("lower(articles.title) like lower(?)", ["%{$keyword}%"])
                      ->orWhereHas('category', function (Builder $query) use ($keyword) {
                          $query->whereRaw("lower(categories.title) like lower(?)", ["%{$keyword}%"]);
                      })
                      ->paginate($limit);
    }
}

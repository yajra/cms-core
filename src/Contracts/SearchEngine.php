<?php

namespace Yajra\CMS\Contracts;

interface SearchEngine
{
    /**
     * @param string $keyword
     * @param int $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function search($keyword, $limit = 10);
}

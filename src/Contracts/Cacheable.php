<?php

namespace Yajra\CMS\Contracts;

interface Cacheable
{
    /**
     * Get list of keys used for caching.
     *
     * @return array
     */
    public function getCacheKeys();
}
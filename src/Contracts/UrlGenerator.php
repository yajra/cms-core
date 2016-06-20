<?php

namespace Yajra\CMS\Contracts;

interface UrlGenerator
{
    /**
     * Get url from implementing class.
     *
     * @param mixed $args
     * @return string
     */
    public function getUrl($args);
}

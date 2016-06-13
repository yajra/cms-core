<?php

namespace Yajra\CMS\Entities\Traits;

trait CanRequireAuthentication
{
    /**
     * Check if menu requires authentication.
     *
     * @return bool
     */
    public function requiresAuthentication()
    {
        return $this->authenticated;
    }
}
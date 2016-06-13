<?php

namespace Yajra\CMS\Repositories\Navigation;

/**
 * Interface NavigationRepository
 *
 * @package App\Repositories\Administrator\Navigation
 */
interface NavigationRepository
{
    /**
     * Get all published navigation.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPublished();
}
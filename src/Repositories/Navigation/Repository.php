<?php

namespace Yajra\CMS\Repositories\Navigation;

/**
 * Interface NavigationRepository
 *
 * @package App\Repositories\Administrator\Navigation
 */
interface Repository
{
    /**
     * Find or fail a navigation.
     *
     * @param int $id
     * @return \Yajra\CMS\Entities\Navigation
     */
    public function findOrFail($id);

    /**
     * Get all published navigation.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPublished();
}

<?php

namespace Yajra\CMS\Entities\Traits;

trait HasOrder
{
    /**
     * Get default order attribute.
     *
     * @param int $order
     * @return int
     */
    public function getOrderAttribute($order)
    {
        return $order ?? 1;
    }
}

<?php

namespace Yajra\CMS\Repositories\Widget;

interface WidgetRepository
{
    /**
     * Get all widgets.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all();

    /**
     * Get all published widgets.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPublished();
}
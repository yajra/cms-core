<?php

namespace Yajra\CMS\Events;

use Yajra\CMS\Entities\Category;

class CategoryWasViewed extends Event
{
    /**
     * @var \Yajra\CMS\Entities\Category
     */
    public $category;

    /**
     * CategoryWasViewed constructor.
     *
     * @param \Yajra\CMS\Entities\Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
}

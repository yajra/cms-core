<?php

namespace Yajra\CMS\Presenters;

use Laracasts\Presenter\Presenter;

class CategoryPresenter extends Presenter
{
    /**
     * Indented title against depth.
     *
     * @param int $pad
     * @return string
     */
    public function indentedTitle($pad = 1)
    {
        return str_repeat('— ', $this->entity->depth - $pad) . $this->entity->title;
    }
}
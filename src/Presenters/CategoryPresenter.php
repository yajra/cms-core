<?php

namespace Yajra\CMS\Presenters;

use Laracasts\Presenter\Presenter;

class CategoryPresenter extends Presenter
{
    /**
     * Indented title against depth.
     *
     * @return string
     */
    public function indentedTitle()
    {
        return str_repeat('— ', $this->entity->depth - 1) . ' ' . $this->entity->title;
    }
}
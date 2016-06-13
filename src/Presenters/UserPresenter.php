<?php

namespace Yajra\CMS\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * Get user's full name.
     *
     * @return string
     */
    public function name()
    {
        return $this->entity->first_name . ' ' . $this->entity->last_name;
    }

    /**
     * Get user's avatar.
     *
     * @return string
     */
    public function avatar()
    {
        return $this->entity->avatar ?? asset('img/avatar.png');
    }

    /**
     * Formatted created_at value.
     *
     * @return string
     */
    public function createdAt()
    {
        return $this->entity->created_at->diffForHumans();
    }
}
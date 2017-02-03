<?php

namespace Yajra\CMS\Events\Users;

use Yajra\CMS\Events\Event;

class UserWasUpdated extends Event
{
    /**
     * @var mixed
     */
    public $user;

    /**
     * UserWasCreated constructor.
     *
     * @param mixed $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
}

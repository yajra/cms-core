<?php

namespace Yajra\CMS\Events\Users;

use Yajra\CMS\Events\Event;

class PasswordWasUpdated extends Event
{
    /**
     * @var mixed
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    /**
     * UserWasCreated constructor.
     *
     * @param mixed $user
     * @param string $password
     */
    public function __construct($user, $password)
    {
        $this->user     = $user;
        $this->password = $password;
    }
}

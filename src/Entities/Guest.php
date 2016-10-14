<?php

namespace Yajra\CMS\Entities;

use App\User;

class Guest extends User
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var string
     */
    protected $primaryKey = 'id';
}

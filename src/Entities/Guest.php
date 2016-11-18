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

    /**
     * Model can have many roles.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function roles()
    {
        return $this->belongsToMany(config('acl.role', Role::class), 'role_user', 'user_id', 'role_id')->withTimestamps();
    }
}

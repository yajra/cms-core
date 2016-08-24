<?php

namespace Yajra\CMS\Http\Controllers;

use Yajra\CMS\Http\NotificationResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Yajra\Acl\Traits\AuthorizesPermissionResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, AuthorizesPermissionResources,
        DispatchesJobs, ValidatesRequests, NotificationResponse;
}

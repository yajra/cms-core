<?php

namespace Yajra\CMS\Http\Controllers;

class TaggingTagsController extends Controller
{
    /**
     * TaggingTagsController constructor.
     */
    public function __construct()
    {
        $this->authorizePermissionResource('tag');
    }
}

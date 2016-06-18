<?php

namespace Yajra\CMS\Repositories\Extension;

interface Repository
{
    public function install($type, array $attributes);

    public function all();

    public function uninstall($id);

    public function findOrFail($id);
}

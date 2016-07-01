<?php

namespace Yajra\CMS\View\Directives;

use Roumen\Asset\Asset;

class AssetAddAfterDirective
{
    /**
     * Page header blade directive compiler.
     * @pageHeader($title, $description, $icon, $template)
     *
     * @param string $add
     * @param string $after
     */
    public function handle($add, $after)
    {
        Asset::addAfter($add, $after);
    }
}
<?php

namespace Yajra\CMS\View\Directives;

use Roumen\Asset\Asset;

class AssetAddBeforeDirective
{
    /**
     * Page header blade directive compiler.
     * @pageHeader($title, $description, $icon, $template)
     *
     * @param string $add
     * @param string $before
     */
    public function handle($add, $before)
    {
        Asset::addAfter($add, $before);
    }
}
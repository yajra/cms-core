<?php

namespace Yajra\CMS\View\Directives;

use Roumen\Asset\Asset;
use Yajra\CMS\Repositories\FileAsset\Repository;

class AssetCssDirective
{
    /**
     * Page header blade directive compiler.
     * @pageHeader($title, $description, $icon, $template)
     *
     * @param string|array $styles
     * @param null $category
     * @param string $group
     */
    public function handle($styles, $group = 'footer', $category = null)
    {
        foreach ((array)$styles as $style) {
            if (! str_contains('.css', $style)) {
                $style .= ".css";
            }
            /** @var \Yajra\CMS\Entities\FileAsset $getData */
            $getData = app(Repository::class)->getByName($style, $category);
            Asset::add($getData ? $getData->url : $style, $group, $category);
        }
    }
}
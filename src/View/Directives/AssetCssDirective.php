<?php

namespace Yajra\CMS\View\Directives;

use Roumen\Asset\Asset;
use Yajra\CMS\Repositories\FileAsset\FileAssetRepository;

class AssetCssDirective
{
    /**
     * Page header blade directive compiler.
     * @pageHeader($title, $description, $icon, $template)
     *
     * @param string|array $styles
     * @param null $category
     */
    public function handle($styles, $category = null)
    {
        foreach ((array)$styles as $style) {
            if (! str_contains('.js', $style)) {
                $style .= ".js";
            }
            Asset::add(app(FileAssetRepository::class)->getByName($style, $category)->url);
        }
    }
}
<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\CMS\Http\Traits\BrowsableTrait;

/**
 * Class ImageBrowserController
 *
 * @package Yajra\CMS\Http\Controllers
 */
class ImageBrowserController extends Controller
{
    use BrowsableTrait;

    /**
     * Get files by directory path.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function getFiles(Request $request)
    {
        $mediaFiles = $this->getMediaFiles($request->get('path'));

        return view('administrator.file-browser.container', compact('mediaFiles'))->render();
    }
}

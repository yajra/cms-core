<?php

namespace Yajra\CMS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\Finder;
use Yajra\CMS\Http\NotificationResponse;

/**
 * Class ImageBrowserController
 *
 * @package Yajra\CMS\Http\Controllers
 */
class ImageBrowserController extends Controller
{
    use NotificationResponse;

    /**
     * Get files by directory path.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $currentPath = $request->get('path');
        $basePath    = storage_path('app/public/' . config('media.root_dir'));
        $dir         = storage_path('app/public/' . $currentPath);
        $imageFiles  = $this->getImageFiles($dir);

        foreach (Finder::create()->in($dir)->sortByType()->directories() as $file) {
            $imageFiles->name($file->getBaseName());
        }

        $files = new Collection;
        $parts = explode('/', $currentPath);
        array_pop($parts);
        if ($parts <> '' && $currentPath <> 'media') {
            $files->push([
                'name'    => '.. Up',
                'relPath' => implode('/', $parts),
                'type'    => 'dir',
                'url'     => url($currentPath),
            ]);
        }

        foreach ($imageFiles as $file) {
            $path = str_replace(storage_path('app/public/'), '', $file->getRealPath());
            $files->push([
                'name'    => $file->getFilename(),
                'relPath' => $path,
                'type'    => $file->getType(),
                'url'     => url($path),
            ]);
        }

        return response()->json($files->groupBy('type'));
    }

    /**
     * Get image files by path.
     *
     * @param string $path
     * @return Finder
     */
    protected function getImageFiles($path)
    {
        $finder = Finder::create()->in($path)->sortByType()->depth(0);
        foreach (config('media.images_ext') as $file) {
            $finder->name('*' . $file);
        }

        return $finder;
    }
}

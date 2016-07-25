<?php

namespace Yajra\CMS\Http\Traits;

use Symfony\Component\Finder\Finder;

/**
 * Class BrowsableTrait
 *
 * @package App\Http\Traits
 */
trait BrowsableTrait
{
    /**
     * Media public storage.
     *
     * @var string
     */
    public $mediaPath = 'app/public/media';

    /**
     * Show all directories on media path.
     *
     * @return array
     */
    public function getFileDirectories()
    {
        $mediaFiles['/'] = '/';
        $path            = storage_path($this->mediaPath);
        foreach ($this->getFiles($path)->directories() as $file) {
            $strFile              = str_replace($path, '', $file->getRealPath());
            $mediaFiles[$strFile] = $strFile;
        }

        return $mediaFiles;
    }

    /**
     * Show all files on selected path.
     *
     * @param string $currentPath
     * @param array $mediaFiles
     * @return array
     */
    public function getMediaFiles($currentPath = null, $mediaFiles = [])
    {
        $path = storage_path('app/public/media' . $currentPath);
        foreach (Finder::create()->in($path)->sortByType()->depth(0) as $file) {
            $mediaFiles[] = [
                'filename' => $file->getFilename(),
                'realPath' => $file->getRealPath(),
                'type'     => $file->getType(),
                'filepath' => str_replace(storage_path('app/public/media'), '', $file->getRealPath()),
            ];
        }

        return $mediaFiles;
    }

    /**
     * Symfony file finder.
     * Show all files in selected $path directory.
     * Sort by file type.
     *
     * @param string $path
     * @return \Symfony\Component\Finder\Finder
     */
    public function getFiles($path)
    {
        return Finder::create()->in($path)->sortByType();
    }
}


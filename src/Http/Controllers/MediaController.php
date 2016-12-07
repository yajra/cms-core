<?php

namespace Yajra\CMS\Http\Controllers;

use App\Http\Requests;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class MediaController extends Controller
{
    /**
     * Filesystem interface.
     *
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected $storage;

    /**
     * Image manager.
     *
     * @var \Intervention\Image\ImageManager
     */
    protected $image;

    /**
     * Config repository.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Media manager template.
     *
     * @var string
     */
    protected $template = 'admin::layouts.master';

    /**
     * Files listing filter.
     *
     * @var null|string
     */
    protected $filter = null;

    /**
     * Current dir the user is browsing.
     *
     * @var string
     */
    protected $currentDir;

    /**
     * @param \Illuminate\Contracts\Filesystem\Filesystem $storage
     * @param \Intervention\Image\ImageManager $image
     * @param \Illuminate\Config\Repository $config
     */
    public function __construct(Filesystem $storage, ImageManager $image, Repository $config)
    {
        $this->storage = $storage;
        $this->image   = $image;
        $this->config  = $config;
    }

    /**
     * Display media browser from CKEditor.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|null $filter
     * @return \Illuminate\Http\Response
     */
    public function browse(Request $request, $filter = null)
    {
        $this->template = 'admin::layouts.component';
        $this->filter   = $filter;

        return $this->index($request);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $storage_root     = $this->getRootDir();
        $accepted_files   = $this->config->get('media.accepted_files');
        $max_file_size    = $this->config->get('media.max_file_size', 3);
        $this->currentDir = $this->getRootDir();

        if ($request->input('folder')) {
            $this->currentDir = $request->input('folder');
            if ($this->storage->exists($this->currentDir) === false) {
                return redirect()->route('administrator.media.index');
            }
        }

        $items = $this->buildFileAndDirectoryListing();

        $directories = $this->buildDirectory(
            $this->scanDirectory($this->getRootDir()),
            $this->getRootDir()
        );

        return view('administrator.media.index')
            ->with('template', $this->template)
            ->with('items', $items)
            ->with('current_directory', $this->currentDir)
            ->with('directories', $directories)
            ->with('accepted_files', $accepted_files)
            ->with('storage_root', $storage_root)
            ->with('max_file_size', $max_file_size);
    }

    /**
     * Get root directory.
     *
     * @return string
     */
    protected function getRootDir()
    {
        return 'public/' . $this->config->get('media.root_dir', 'media');
    }

    /**
     * Build files and directory collection for the current directory.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function buildFileAndDirectoryListing()
    {
        $collection  = new Collection;
        $files       = $this->scanFiles($this->currentDir);
        $thumbnails  = $this->buildThumbnails($files);
        $directories = $this->scanDirectory($this->currentDir);

        if ($this->getRootDir() <> $this->currentDir) {
            $back_directory    = implode('/', explode('/', $this->currentDir, -1));
            $item              = [];
            $item['thumbnail'] = '';
            $item['filename']  = '...';
            $item['size']      = '';
            $item['type']      = 'back';
            $item['icon']      = 'fa-reply';
            $item['path']      = $this->currentDir;
            $item['url']       = '?folder=' . $back_directory;
            $item['delete']    = currentUser()->can('media.delete');
            $item['select']    = currentUser()->can('media.view');
            $collection->add($item);
        }

        foreach ($directories as $directory) {
            $directory_name = explode('/', $directory);
            $directory_name = array_pop($directory_name);

            $item              = [];
            $item['thumbnail'] = '';
            $item['filename']  = $directory_name;
            $item['path']      = $directory;
            $item['size']      = '';
            $item['type']      = 'directory';
            $item['icon']      = 'fa-folder';
            $item['url']       = '?folder=' . $directory;
            $item['delete']    = currentUser()->can('media.delete');
            $item['select']    = currentUser()->can('media.view');

            $collection->add($item);
        }

        foreach ($files as $path) {
            $item     = [];
            $parts    = explode('/', $path);
            $filename = array_pop($parts);
            $size     = $this->storage->size($path);
            $icon     = file_ext_to_icon(File::extension($path));

            $item['type']      = 'file';
            $item['icon']      = $icon;
            $item['thumbnail'] = '';
            if (file_can_have_thumbnail($path)) {
                $item['type']      = 'image';
                $item['icon']      = 'fa-image';
                $item['thumbnail'] = $thumbnails[$path];
            }

            $item['filename'] = $filename;
            $item['size']     = $size;
            $item['url']      = preg_replace("/^public/", '', $path);
            $item['path']     = $path;
            $item['delete']   = currentUser()->can('media.delete');
            $item['select']   = currentUser()->can('media.view');
            $collection->add($item);
        }

        return $collection;
    }

    /**
     * Scan files of the given directory.
     *
     * @param $current_directory
     * @return \Illuminate\Support\Collection
     */
    protected function scanFiles($current_directory)
    {
        $files = collect($this->storage->files($current_directory));
        $files = $files->filter(function ($file) {
            $ext = File::extension($file);

            if ($this->filter === 'images') {
                return in_array($ext, $this->config->get('media.images_ext'));
            } elseif ($this->filter === 'files') {
                return in_array($ext, $this->config->get('media.files_ext'));
            }

            return true;
        });

        return $files;
    }

    /**
     * Build thumbnails for each files that is image type.
     *
     * @param \Illuminate\Support\Collection $files
     * @return array
     */
    protected function buildThumbnails($files)
    {
        $thumbnails = [];

        foreach ($files as $file) {
            if (file_can_have_thumbnail($file)) {
                $thumbnails[$file] = (string) $this->image
                    ->make($this->storage->get($file))
                    ->resize(20, 20)->encode('data-url');
            }
        }

        return $thumbnails;
    }

    /**
     * Scan the directory.
     *
     * @param string $dir
     * @return \Illuminate\Support\Collection
     */
    protected function scanDirectory($dir)
    {
        return collect($this->storage->directories($dir));
    }

    /**
     * Build the directory lists.
     *
     * @param \Illuminate\Support\Collection $directories
     * @param string $parent
     * @return string
     */
    protected function buildDirectory($directories, $parent)
    {
        $directories = $directories->map(function ($dir) use ($parent) {
            $dir = str_replace($parent . '/', '', $dir);

            return $dir;
        });

        $html = '<ul>';
        $directories->each(function ($dir) use (&$html, $parent) {
            $subParent = $parent . '/' . $dir;
            $url       = request()->url() . '?folder=' . $subParent;

            $html .= "<li>";
            $html .= "<a href='{$url}'>{$dir}</a>";
            if ($child = $this->scanDirectory($subParent)) {
                $html .= $this->buildDirectory($child, $subParent);
            }
            $html .= "</li>";
        });
        $html .= '</ul>';

        return $html;
    }

    /**
     * Upload a file.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFile(Request $request)
    {
        $maxSize   = $this->config->get('media.max_file_size', 3);
        $validator = $this->getValidationFactory()->make($request->all(), [
            'file' => 'required|mimes:' . $this->getAcceptedFiles() . '|max:' . $maxSize * 1024,
        ]);

        if ($validator->fails()) {
            return response($validator->getMessageBag()->get('file')[0], 500);
        }

        $filename = trim($request->file('file')->getClientOriginalName());
        if ($this->storage->exists($request->input('current_directory') . '/' . $filename)) {
            return response($filename . " already exists.", 500);
        }

        $this->storage->put(
            $request->input('current_directory') . '/' . $filename,
            file_get_contents($request->file('file'))
        );

        return redirect()->back();
    }

    /**
     * Get accepted files for upload.
     *
     * @return string
     */
    protected function getAcceptedFiles()
    {
        $accepted_files = str_replace(' ', '',
            str_replace('.', '', $this->config->get('media.accepted_files'))
        );

        return $accepted_files;
    }

    /**
     * Create a folder.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFolder(Request $request)
    {
        // check if public/media is the parent folder
        if (strpos($request->input('current_directory'), $this->getRootDir()) === false) {
            flash()->error('Invalid folder!');

            return redirect()->back();
        }

        // check if alphanumeric and no space
        if (! ctype_alnum($request->input('new_directory'))) {
            flash()->error('Invalid folder name! Folder name must be alphanumeric only and no space');

            return redirect()->back();
        }

        $this->storage->makeDirectory(
            $request->input('current_directory') . '/' . $request->input('new_directory')
        );

        // new current directory
        $folder = $request->input('current_directory') . '/' . $request->input('new_directory');
        flash()->success('New Folder added successfully!');

        return redirect()->back()->with('folder', $folder);
    }

    /**
     * Delete a file(/s) and/or folder(/s).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteMedia(Request $request)
    {
        // if single file/folder '?s=name'
        if ($request->has('s')) {
            if (is_dir(storage_path('app') . DIRECTORY_SEPARATOR . $request->input('s'))) {
                return $this->deleteDirectory($request);
            } else {
                return $this->deleteFile($request);
            }
        }

        // if multiple files
        if ($request->has('files')) {
            $this->storage->delete($request->input('files'));
        }

        // if multiple directories
        if ($request->has('directories')) {
            if (is_array($request->input('directories'))) {
                foreach ($request->input('directories') as $directory) {
                    $this->storage->deleteDirectory($directory);
                }
            } else {
                $this->storage->deleteDirectory($request->input('directories'));
            }
        }

        if ($request->wantsJson()) {
            return $this->notifySuccess('File/Folder deleted successfully!');
        }

        flash()->success('File/Folder deleted successfully!');

        return redirect()->back();
    }

    /**
     * Delete a single directory from request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function deleteDirectory(Request $request)
    {
        try {
            $dir = $request->input('s');
            $this->storage->deleteDirectory($dir);

            return $this->notifySuccess($dir . ' successfully deleted!');
        } catch (\ErrorException $e) {
            return $this->notifyError($e->getMessage());
        }
    }

    /**
     * Delete a single file from request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function deleteFile(Request $request)
    {
        try {
            $file = $request->input('s');
            $this->storage->delete($file);

            return $this->notifySuccess($file . ' successfully deleted!');
        } catch (\ErrorException $e) {
            return $this->notifyError($e->getMessage());
        }
    }
}

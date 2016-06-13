<?php

if (! function_exists('datatables')) {
    /**
     * Get datatables instance.
     *
     * @return \Yajra\Datatables\Datatables
     */
    function datatables()
    {
        return app('datatables');
    }
}

if (! function_exists('dt_render')) {
    /**
     * Render a view.
     *
     * @param string $view
     * @param array $data
     * @return string
     */
    function dt_render($view, $data = [])
    {
        return view($view, $data)->render();
    }
}

if (! function_exists('dt_label')) {
    /**
     * Display a label view.
     *
     * @param string $label
     * @param string $type
     * @return string
     */
    function dt_label($label, $type = 'info')
    {
        return dt_render('datatables::label', compact('label', 'type'));
    }
}

if (! function_exists('dt_badge')) {
    /**
     * Display a badge view.
     *
     * @param string $label
     * @param string $type
     * @return string
     */
    function dt_badge($label, $type = 'info')
    {
        return dt_render('datatables::badge', compact('label', 'type'));
    }
}

if (! function_exists('dt_check')) {
    /**
     * Display a checkbox view.
     *
     * @param bool $checked
     * @return string
     */
    function dt_check($checked = true)
    {
        return dt_render('datatables::check', compact('checked'));
    }
}

if (! function_exists('currentUser')) {
    /**
     * Get current user instance.
     *
     * @param string|null $guard
     * @return \App\User
     */
    function currentUser($guard = null)
    {
        return auth($guard)->user();
    }
}

if (! function_exists('file_can_have_thumbnail')) {
    /**
     * Check if file is an image and can have thumbnail.
     *
     * @param string $file
     * @return bool
     */
    function file_can_have_thumbnail($file)
    {
        return exif_imagetype(substr($file, 7));
    }
}

if (! function_exists('html')) {
    /**
     * Get html builder instance.
     *
     * @return \Collective\Html\HtmlBuilder
     */
    function html()
    {
        return app('html');
    }
}

if (! function_exists('form')) {
    /**
     * Get html builder instance.
     *
     * @return \Collective\Html\FormBuilder
     */
    function form()
    {
        return app('form');
    }
}

if (! function_exists('bytesToHuman')) {
    /**
     * Convert bytes to a human readable presentation.
     *
     * @param int $bytes
     * @return string
     */
    function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}

if (! function_exists('file_ext_to_icon')) {
    /**
     * Get font-awesome icon by file ext.
     *
     * @param string $ext
     * @return string
     */
    function file_ext_to_icon($ext)
    {
        $icons = [
            'pdf'   => 'fa-file-pdf-o',
            'doc'   => 'fa-file-word-o',
            'docx'  => 'fa-file-word-o',
            'ppt'   => 'fa-file-powerpoint-o',
            'pptx'  => 'fa-file-powerpoint-o',
            'xls'   => 'fa-file-excel-o',
            'xlsx'  => 'fa-file-excel-o',
            'csv'   => 'fa-file-excel-o',
            'zip'   => 'fa-file-archive-o',
            'tar'   => 'fa-file-archive-o',
            'gz'    => 'fa-file-archive-o',
            'rar'   => 'fa-file-archive-o',
            'audio' => 'fa-file-audio-o',
            'mp3'   => 'fa-file-audio-o',
            'wav'   => 'fa-file-audio-o',
            'txt'   => 'fa-file-code-o',
            'html'  => 'fa-file-code-o',
            'php'   => 'fa-file-code-o',
            'jpg'   => 'fa-file-image-o',
            'jpeg'  => 'fa-file-image-o',
            'png'   => 'fa-file-image-o',
            'gif'   => 'fa-file-image-o',
            'bmp'   => 'fa-file-image-o',
            'tiff'  => 'fa-file-image-o',
            'mov'   => 'fa-file-movie-o',
            'mp4'   => 'fa-file-movie-o',
            'avi'   => 'fa-file-movie-o',
        ];

        if (in_array($ext, array_keys($icons))) {
            return $icons[$ext];
        }

        return 'fa-file-o';
    }
}
<?php

namespace Yajra\CMS\View\Directives;

class ErrorDirective
{
    /**
     * Session error directive compiler.
     * @error('key')
     *
     * @param string $key
     * @param string $class
     * @param string $tag
     * @return string
     */
    public function handle($key, $class = 'help-block', $tag = 'span')
    {
        $key = str_replace(['\'', '"'], '', $key);
        $errors = session('errors') ?? new \Illuminate\Support\ViewErrorBag;
        
        if ($message = $errors->first($key)) {
            return view('system.directives.error', compact('message', 'class', 'tag'))->render();
        }
    }
}

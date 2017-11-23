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
     * @return string
     */
    public function handle($key, $class = 'help-block')
    {
        $key = str_replace(['\'', '"'], '', $key);
        $errors = session('errors') ?? new \Illuminate\Support\ViewErrorBag;
        
        if ($message = $errors->first($key)) {
            return view('system.form.error', compact('message', 'class'))->render();
        }
    }
}

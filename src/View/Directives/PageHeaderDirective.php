<?php

namespace Yajra\CMS\View\Directives;

class PageHeaderDirective
{
    /**
     * Page header blade directive compiler.
     * @pageHeader($title, $description, $icon, $template)
     *
     * @param string $title
     * @param string $description
     * @param string $icon
     * @param string $template
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function handle($title, $description, $icon, $template = 'system.directives.page-title')
    {
        return view($template, compact('title', 'description', 'icon'))->render();
    }
}

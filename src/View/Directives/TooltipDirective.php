<?php

namespace Yajra\CMS\View\Directives;

class TooltipDirective
{
    /**
     * Tooltip blade directive compiler.
     * @tooltip($tooltip, $template)
     *
     * @param string $tooltip
     * @param string $template
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function handle($tooltip, $template = 'system.tooltip')
    {
        $tooltip = trans($tooltip);

        return view($template, compact('tooltip'))->render();
    }
}
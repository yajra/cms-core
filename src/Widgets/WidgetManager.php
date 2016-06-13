<?php

namespace Yajra\CMS\Widgets;

class WidgetManager
{
    /**
     * @var array
     */
    protected $widgets = [];

    /**
     * @param string $widget
     * @param string $classPath
     * @return $this
     */
    public function register($widget, $classPath)
    {
        $this->widgets[$widget] = $classPath;

        return $this;
    }

    /**
     * Get FQCN of the widget.
     *
     * @param string $widget
     * @return string
     * @throws \Exception
     */
    public function getClass($widget)
    {
        if (in_array($widget, array_keys($this->widgets))) {
            return $this->widgets[$widget];
        }

        throw new \Exception('Requested widget is not available!');
    }
}

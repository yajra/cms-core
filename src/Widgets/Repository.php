<?php

namespace Yajra\CMS\Widgets;

class Repository
{
    /**
     * @var array
     */
    protected $widgets = [];

    /**
     * @param string $widget
     * @param string $description
     * @param string $classPath
     * @param array $templates
     * @return $this
     */
    public function register($widget, $description, $classPath, $templates = [])
    {
        $this->widgets[$widget] = new Widget($widget, $description, $classPath, $templates);

        return $this;
    }

    /**
     * Find or fail a widget.
     *
     * @param string $widget
     * @return \Yajra\CMS\Widgets\Widget
     * @throws \Yajra\CMS\Widgets\NotFoundException
     */
    public function findOrFail($widget)
    {
        if (in_array($widget, array_keys($this->widgets))) {
            return $this->widgets[$widget];
        }

        throw new NotFoundException('Widget not found!');
    }
}

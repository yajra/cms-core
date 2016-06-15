<?php

namespace Yajra\CMS\Widgets;

class Widget
{
    /**
     * Widget name.
     *
     * @var string
     */
    public $name;

    /**
     * FQCN of the widget.
     *
     * @var string
     */
    public $class;

    /**
     * Lists of blade templates.
     *
     * @var array
     */
    public $templates = [];

    /**
     * Widget description.
     *
     * @var string
     */
    public $description;

    /**
     * Widget constructor.
     *
     * @param string $name
     * @param string $description
     * @param string $classPath
     * @param array $templates
     */
    public function __construct($name, $description, $classPath, array $templates)
    {
        $this->name        = $name;
        $this->description = $description;
        $this->class       = $classPath;
        $this->templates   = $templates;
    }
}

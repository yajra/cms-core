<?php

namespace Yajra\CMS\Widgets;

class Widget
{
    /**
     * Widget name.
     *
     * @var string
     */
    protected $name;

    /**
     * FQCN of the widget.
     *
     * @var string
     */
    protected $class;

    /**
     * Lists of blade templates.
     *
     * @var array
     */
    protected $templates = [];

    /**
     * Widget description.
     *
     * @var string
     */
    protected $description;

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

    /**
     * Get widget name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get widget FQCN.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Get widget templates.
     *
     * @return array
     */
    public function getTemplates()
    {
        return $this->templates;
    }

    /**
     * Get widget description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

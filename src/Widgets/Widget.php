<?php

namespace Yajra\CMS\Widgets;

use Illuminate\Support\Fluent;
use Illuminate\Support\Str;

class Widget extends Fluent
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var object
     */
    public $templates;

    /**
     * Widget constructor.
     *
     * @param array|object $attributes
     */
    public function __construct($attributes)
    {
        parent::__construct($attributes);

        $this->name        = Str::lower($this->get('name'));
        $this->description = $this->get('description');
        $this->templates   = $this->get('templates');
    }
}

<?php

namespace Yajra\CMS\Entities\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

class FluentParameters extends Fluent
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $templates;

    /**
     * FluentParameters constructor.
     *
     * @param array|object $attributes
     */
    public function __construct($attributes)
    {
        parent::__construct($attributes);

        if (isset($attributes['templates']) && is_array($attributes['templates'])) {
            $templates = new Collection;
            foreach ($attributes['templates'] as $template) {
                $templates->push(new Fluent($template));
            }

            $this->templates = $templates;
        }
    }
}

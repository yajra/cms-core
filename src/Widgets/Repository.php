<?php

namespace Yajra\CMS\Widgets;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Collection;

class Repository
{
    use ValidatesRequests;

    /**
     * @var array
     */
    protected $widgets = [];

    /**
     * Register a widget.
     *
     * @param array $attributes
     * @return $this
     * @throws \Exception
     */
    public function register(array $attributes)
    {
        $validator = $this->getValidationFactory()->make($attributes, [
            'type'        => 'required',
            'name'        => 'required',
            'version'     => 'required',
            'class'       => 'required',
            'templates'   => 'required',
        ]);

        if ($validator->fails()) {
            throw new \Exception('Invalid widget config detected!');
        }

        $this->widgets[$attributes['type']] = new Widget($attributes);

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

    /**
     * Get all registered widgets.
     *
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return new Collection($this->widgets);
    }
}

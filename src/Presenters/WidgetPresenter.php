<?php

namespace Yajra\CMS\Presenters;

use Laracasts\Presenter\Presenter;
use Yajra\CMS\Widgets\Repositories\EloquentRepository;

class WidgetPresenter extends Presenter
{
    /**
     * Get widget's view template.
     *
     * @return string
     */
    public function template()
    {
        return $this->entity->template === 'custom' ? $this->entity->custom_template : $this->entity->template;
    }

    /**
     * Get widget type FQCN.
     *
     * @return string
     * @throws \Exception
     */
    public function class()
    {
        /** @var \Yajra\CMS\Widgets\Repositories\EloquentRepository $repository */
        $repository = app('widgets');
        /** @var \Yajra\CMS\Entities\Extension $widget */
        $widget = $repository->findOrFail($this->entity->extension_id);

        return $widget->manifest['class'];
    }
}

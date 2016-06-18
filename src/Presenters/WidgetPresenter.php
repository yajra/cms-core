<?php

namespace Yajra\CMS\Presenters;

use Laracasts\Presenter\Presenter;

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
        /** @var \Yajra\CMS\Repositories\Extension\Repository $repository */
        $repository = app('extensions');
        $extension  = $repository->findOrFail($this->entity->extension_id);

        return $extension->manifest['class'];
    }
}

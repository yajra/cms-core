<?php

namespace Yajra\CMS\Presenters;

use Yajra\CMS\Widgets\WidgetManager;
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
    public function type()
    {
        /** @var WidgetManager $manager */
        $manager = app(WidgetManager::class);

        return $manager->getClass($this->entity->type);
    }
}

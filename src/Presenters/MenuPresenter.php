<?php

namespace Yajra\CMS\Presenters;

use Laracasts\Presenter\Presenter;
use Yajra\CMS\Contracts\UrlGenerator;

class MenuPresenter extends Presenter
{
    /**
     * Link href target window.
     *
     * @return string
     */
    public function target()
    {
        return $this->entity->target == 0 ? '_self' : '_blank';
    }

    /**
     * Indented title against depth.
     *
     * @param int $start
     * @param string $symbol
     * @return string
     */
    public function indentedTitle($start = 1, $symbol = '— ')
    {
        $repeat = $this->entity->depth - $start;

        return str_repeat($symbol, $repeat >=0 ? $repeat : 0) . ' ' . $this->entity->title;
    }

    /**
     * Generate menu url depending on type the menu.
     *
     * @return string
     */
    public function url()
    {
        /** @var \Yajra\CMS\Repositories\Extension\Repository $repository */
        $repository = app('extensions');
        /** @var \Yajra\CMS\Entities\Extension $extension */
        $extension  = $repository->findOrFail($this->entity->extension_id);
        $class      = $extension->param('class');
        if (class_exists($class)) {
            $entity = app($class)->findOrNew($this->entity->param('id'));
            if ($entity instanceof UrlGenerator) {
                return $entity->getUrl($extension->param('data'));
            }
        }

        return url($this->entity->url);
    }
}

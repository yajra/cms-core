<?php

namespace Yajra\CMS\Entities\Traits;

trait PublishableTrait
{
    /**
     * Published an entity.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function publish()
    {
        $this->published = true;
        $this->save();

        return $this;
    }

    /**
     * Published/Unpublished an entity.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function togglePublishedState()
    {
        $this->published = ! $this->published;
        $this->save();

        return $this;
    }

    /**
     * Unpublished an entity.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function unpublish()
    {
        $this->published = false;
        $this->save();

        return $this;
    }

    /**
     * Query scope for published articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    /**
     * Query scope for unpublished articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnpublished($query)
    {
        return $query->where('published', false);
    }

    /**
     * Check if entity was published.
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->published;
    }
}

<?php

namespace Yajra\CMS\Entities;

use Yajra\CMS\Contracts\UrlGenerator;
use Yajra\CMS\Entities\Traits\CanRequireAuthentication;
use Yajra\CMS\Entities\Traits\HasParameters;
use Yajra\CMS\Entities\Traits\PublishableTrait;
use Yajra\CMS\Presenters\CategoryPresenter;
use Baum\Node;
use Laracasts\Presenter\PresentableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Yajra\Auditable\AuditableTrait;

/**
 * @property int depth
 * @property string title
 * @property int id
 * @property bool published
 * @property bool authenticated
 * @property string alias
 * @property int hits
 */
class Category extends Node implements UrlGenerator
{
    use AuditableTrait, PresentableTrait, PublishableTrait;
    use HasSlug, CanRequireAuthentication, HasParameters;

    /**
     * @var \Yajra\CMS\Presenters\CategoryPresenter
     */
    protected $presenter = CategoryPresenter::class;

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'parent_id',
        'published',
        'authenticated',
        'depth',
        'description',
        'title',
        'alias',
        'parameters',
        'created_at',
        'updated_at',
    ];

    /**
     * Get lists of categories.
     *
     * @return array
     */
    public static function lists()
    {
        $root  = static::root();
        $items = [];

        foreach ($root->descendants()->orderBy('lft')->get() as $category) {
            $items[] = [
                'title' => $category->present()->indentedTitle(),
                'id'    => $category->id,
            ];
        }

        return array_pluck($items, 'title', 'id');
    }

    /**
     * @return array
     */
    public static function lookup()
    {
        $root  = static::root();
        $items = [];

        foreach ($root->getDescendants() as $category) {
            $items[] = [
                'title' => $category->present()->indentedTitle(),
                'id'    => $category->id . ':' . $category->alias,
            ];
        }

        return array_pluck($items, 'title', 'id');
    }

    /**
     * Get list of possible parent node.
     *
     * @return array
     */
    public function getParentsList()
    {
        /** @var static $root */
        $root  = static::root();
        $items = [
            ['id' => '1', 'title' => 'Item Root'],
        ];

        if ($this->exists) {
            $parents = $this->ancestors()
                            ->withoutRoot()
                            ->orWhere(function ($query) {
                                $query->where('depth', $this->depth)->where('id', '<>', $this->id);
                            })
                            ->get();
            foreach ($parents as $parent) {
                $items[] = [
                    'title' => $parent->present()->indentedTitle(),
                    'id'    => $parent->id,
                ];
            }
        } else {
            foreach ($root->getDescendants() as $parent) {
                $items[] = [
                    'title' => $parent->present()->indentedTitle(),
                    'id'    => $parent->id,
                ];
            }
        }

        return array_pluck($items, 'title', 'id');
    }

    /**
     * Count published articles.
     *
     * @return int
     */
    public function countPublished()
    {
        return $this->articles()->published()->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Count unpublished articles.
     *
     * @return int
     */
    public function countUnpublished()
    {
        return $this->articles()->unpublished()->count();
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('alias');
    }

    /**
     * Get url from implementing class.
     *
     * @param mixed $args
     * @return string
     */
    public function getUrl($args)
    {
        return 'category/' . $this->alias . '/' . $args;
    }
}

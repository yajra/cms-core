<?php

namespace Yajra\CMS\Entities;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Laracasts\Presenter\PresentableTrait;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Yajra\Acl\Models\Permission;
use Yajra\Acl\Traits\HasPermission;
use Yajra\Auditable\AuditableTrait;
use Yajra\CMS\Contracts\Cacheable;
use Yajra\CMS\Contracts\UrlGenerator;
use Yajra\CMS\Entities\Traits\CanRequireAuthentication;
use Yajra\CMS\Entities\Traits\HasParameters;
use Yajra\CMS\Entities\Traits\PublishableTrait;
use Yajra\CMS\Presenters\ArticlePresenter;

/**
 * Class Article
 *
 * @package App
 * @property int id
 * @property string title
 * @property string alias
 * @property boolean published
 * @property boolean featured
 * @property int category_id
 * @property bool authenticated
 * @property bool is_page
 * @property Collection permissions
 * @property int hits
 * @property int order
 * @property string parameters
 * @property string authorization
 * @property string author_alias
 * @property Category category
 */
class Article extends Model implements UrlGenerator, Cacheable
{
    use AuditableTrait, PublishableTrait, HasSlug;
    use CanRequireAuthentication, HasPermission, PresentableTrait;
    use HasParameters, SortableTrait, Taggable;

    public $sortable = [
        'order_column_name'  => 'order',
        'sort_when_creating' => true,
    ];

    /**
     * @var \Yajra\CMS\Presenters\ArticlePresenter
     */
    protected $presenter = ArticlePresenter::class;

    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'alias',
        'published',
        'category_id',
        'body',
        'order',
        'featured',
        'parameters',
        'blade_template',
        'authenticated',
        'authorization',
        'author_alias',
    ];

    /**
     * Find a published article by slug.
     *
     * @param string $slug
     * @return \Yajra\CMS\Entities\Article|null
     */
    public static function findBySlug(string $slug)
    {
        return static::published()->where('alias', $slug)->firstOrFail();
    }

    /**
     * Get popular articles.
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public static function getPopular($limit = 5)
    {
        return static::where('hits', '>', 0)->orderBy('hits', 'desc')->limit($limit)->get();
    }

    /**
     * Get recently added articles.
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public static function getRecentlyAdded($limit = 5)
    {
        return static::latest()->limit($limit)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
                          ->generateSlugsFrom('title')
                          ->saveSlugsTo('alias');
    }

    /**
     * Get associated permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'article_permission');
    }

    /**
     * Get order attribute or set default value to 1.
     *
     * @return int
     */
    public function getOrderAttribute()
    {
        return $this->attributes['order'] ?? 1;
    }

    /**
     * Get url from implementing class.
     *
     * @param mixed $args
     * @return string
     */
    public function getUrl($args = null)
    {
        if ($this->is_page) {
            return url($this->alias);
        }

        return url($this->category->getUrl($args) . '/' . $this->alias);
    }

    /**
     * Get article's route name.
     *
     * @return string
     */
    public function getRouteName()
    {
        if ($this->is_page) {
            return $this->alias;
        }

        return $this->category->getRouteName() . '.' . $this->alias;
    }

    /**
     * Get list of keys used for caching.
     *
     * @return array
     */
    public function getCacheKeys()
    {
        return [
            'articles.published'
        ];
    }
}

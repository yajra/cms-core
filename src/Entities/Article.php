<?php

namespace Yajra\CMS\Entities;

use Conner\Tagging\Taggable;
use Illuminate\Database\Eloquent\Builder;
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
 * @property int        id
 * @property string     title
 * @property string     body
 * @property string     alias
 * @property boolean    published
 * @property boolean    featured
 * @property int        category_id
 * @property bool       authenticated
 * @property bool       is_page
 * @property Collection permissions
 * @property int        hits
 * @property int        order
 * @property string     parameters
 * @property string     authorization
 * @property string     author_alias
 * @property Category   category
 * @property mixed      blade_template
 */
class Article extends Model implements UrlGenerator, Cacheable
{
    use AuditableTrait, PublishableTrait, HasSlug;
    use CanRequireAuthentication, HasPermission, PresentableTrait;
    use HasParameters, SortableTrait, Taggable;

    /**
     * @var array
     */
    public $sortable = [
        'order_column_name'  => 'order',
        'sort_when_creating' => true,
    ];

    /**
     * @var \Yajra\CMS\Presenters\ArticlePresenter
     */
    protected $presenter = ArticlePresenter::class;

    /**
     * @var array
     */
    protected $casts = [
        'featured'   => 'bool',
        'published'  => 'bool',
        'parameters' => 'array',
    ];

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
        'theme',
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
     * Boot model.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function (Article $article) {
            $article->slug = $article->computeSlug();
        });
    }

    /**
     * Compute article slug.
     *
     * @return string
     */
    public function computeSlug()
    {
        if ($this->is_page) {
            return $this->alias;
        }

        if (! $this->exists) {
            $category = Category::query()->findOrFail($this->category_id);
        } else {
            $category = $this->category;
        }

        return $category->slug . '/' . $this->alias;
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
                          ->saveSlugsTo('alias')
                          ->doNotGenerateSlugsOnUpdate();
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
        return url($this->slug);
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

        return str_replace('category-', '', $this->category->getRouteName() . '.' . $this->alias);
    }

    /**
     * Get list of keys used for caching.
     *
     * @return array
     */
    public function getCacheKeys()
    {
        return [
            'articles.published',
        ];
    }

    /**
     * Query scope to get only articles.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIsNotPage(Builder $builder)
    {
        return $builder->where('is_page', false);
    }

    /**
     * Query scope to get featured articles.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopeFeatured(Builder $builder)
    {
        return $builder->where('featured', true);
    }

    /**
     * Toggle featured state.
     *
     * @return $this
     */
    public function toggleFeaturedState()
    {
        $this->featured = ! $this->featured;
        $this->save();

        return $this;
    }

    /**
     * Update article hits without updating the timestamp.
     *
     * @return $this
     */
    public function visited()
    {
        $this->hits++;

        $this->newQuery()
             ->toBase()
             ->where($this->getKeyName(), $this->getKey())
             ->increment('hits');

        return $this;
    }

    /**
     * Get article's template.
     *
     * @return mixed|string
     */
    public function getTemplate()
    {
        $view = 'articles' . str_replace('//', '.', $this->slug);
        if (view()->exists($view)) {
            return $view;
        }

        return $this->hasTemplate() ? $this->blade_template : 'article.show';
    }

    /**
     * Check if article has custom blade template/layout.
     *
     * @return bool
     */
    public function hasTemplate()
    {
        return ! empty($this->blade_template);
    }

    /**
     * Check if article has custom theme.
     *
     * @return bool
     */
    public function hasTheme()
    {
        return ! empty($this->theme);
    }

    /**
     * Get article's theme.
     *
     * @return mixed
     */
    public function getTheme()
    {
        return $this->theme;
    }
}

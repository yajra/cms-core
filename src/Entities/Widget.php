<?php

namespace Yajra\CMS\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Yajra\Acl\Models\Permission;
use Yajra\Acl\Traits\HasPermission;
use Yajra\Auditable\AuditableTrait;
use Yajra\CMS\Contracts\Cacheable;
use Yajra\CMS\Entities\Traits\CanRequireAuthentication;
use Yajra\CMS\Entities\Traits\HasOrder;
use Yajra\CMS\Entities\Traits\HasParameters;
use Yajra\CMS\Presenters\WidgetPresenter;

/**
 * @property string title
 * @property string template
 * @property string custom_template
 * @property string position
 * @property int order
 * @property bool published
 * @property bool authenticated
 * @property string body
 * @property string parameter
 * @property string parameters
 * @property string type
 * @property int id
 * @property string authorization
 * @property Collection|Permission[] permissions
 * @property bool show_title
 * @property int extension_id
 */
class Widget extends Model implements Cacheable
{
    use PresentableTrait, AuditableTrait, CanRequireAuthentication;
    use HasParameters, HasPermission, HasOrder;
    const ALL_PAGES      = 0;
    const NO_PAGES       = 1;
    const SELECTED_PAGES = 2;

    /**
     * @var \Yajra\CMS\Presenters\WidgetPresenter
     */
    protected $presenter = WidgetPresenter::class;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'position',
        'extension_id',
        'template',
        'custom_template',
        'order',
        'parameter',
        'parameters',
        'authenticated',
        'authorization',
        'body',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('menu_assignment', function(Builder $builder) {
            $widget     = new Widget;
            $assignment = [0];
            if (session()->has('active_menu')) {
                $assignment[] = session('active_menu')->id;
            }

            $widgets    = $widget->getConnection()->table('widget_menu');
            $widgets    = $widgets->whereIn('menu_id', $assignment);
            $builder->whereIn('id', $widgets->pluck('widget_id'));
        });
    }

    /**
     * Query scope by widget position.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $position
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePosition($query, $position)
    {
        return $query->where('position', $position)->published()->orderBy('order', 'asc');
    }

    /**
     * Query scope by widget published state.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    /**
     * Get list of keys used for caching.
     *
     * @return array
     */
    public function getCacheKeys()
    {
        return [
            'widgets.published',
            'widgets.all',
        ];
    }

    /**
     * Get associated permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'widget_permission');
    }

    /**
     * Get menu assignment attribute.
     *
     * @return int
     */
    public function getAssignmentAttribute()
    {
        if (! $this->exists) {
            return static::ALL_PAGES;
        }

        $count = $this->menuPivot()->count();
        if ($count === 0) {
            return static::NO_PAGES;
        } elseif ($count > 1) {
            return static::SELECTED_PAGES;
        } elseif ($count === 1) {
            $pivot = $this->menuPivot()->first();
            if ($pivot->menu_id > 0) {
                return static::SELECTED_PAGES;
            }
        }

        return static::ALL_PAGES;
    }

    /**
     * Get related menus.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function menuPivot()
    {
        return $this->getConnection()->table('widget_menu')
                    ->where('widget_id', $this->id)
                    ->orWhere(function ($query) {
                        $query->where('menu_id', 0)
                              ->where('widget_id', $this->id);
                    });
    }

    /**
     * Sync widget menu assignment.
     *
     * @param array $menu
     * @param int $assignment
     * @return $this
     */
    public function syncMenuAssignment($menu, $assignment)
    {
        switch ($assignment) {
            case static::ALL_PAGES:
                $this->menus()->sync([static::ALL_PAGES]);
                break;
            case static::NO_PAGES:
                $this->menus()->detach();
                break;
            case static::SELECTED_PAGES:
                $this->menus()->sync($menu);
                break;
        }

        return $this;
    }

    /**
     * Get related menus.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'widget_menu');
    }

    /**
     * Get related extension.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function extension()
    {
        return $this->belongsTo(Extension::class);
    }
}

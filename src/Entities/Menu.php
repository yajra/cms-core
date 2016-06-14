<?php

namespace Yajra\CMS\Entities;

use Yajra\CMS\Entities\Traits\CanRequireAuthentication;
use Yajra\CMS\Entities\Traits\HasParameters;
use Yajra\CMS\Entities\Traits\PublishableTrait;
use Yajra\CMS\Presenters\MenuPresenter;
use Baum\Node;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Yajra\Acl\Models\Permission;
use Yajra\Auditable\AuditableTrait;

/**
 * @property int depth
 * @property string title
 * @property int id
 * @property mixed children
 * @property boolean published
 * @property int order
 * @property string url
 * @property int target
 * @property bool authenticated
 * @property string type
 * @property string parameters
 * @property string authorization
 * @property mixed permissions
 * @property mixed widgets
 */
class Menu extends Node
{
    use PresentableTrait, PublishableTrait, CanRequireAuthentication;
    use AuditableTrait, HasParameters;

    /**
     * @var array
     */
    protected $touches = ['navigation'];

    /**
     * @var \Yajra\CMS\Presenters\MenuPresenter
     */
    protected $presenter = MenuPresenter::class;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
        'target',
        'order',
        'parent_id',
        'published',
        'authenticated',
        'authorization',
        'parameters',
        'type',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function navigation()
    {
        return $this->belongsTo(Navigation::class);
    }

    /**
     * Related menu permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Get related article.
     *
     * @return \Yajra\CMS\Entities\Article
     */
    public function article()
    {
        return Article::findOrNew($this->fluentParameters()->get('article_id', 0));
    }

    /**
     * Get related category.
     *
     * @return \Yajra\CMS\Entities\Article
     */
    public function category()
    {
        $category   = $this->fluentParameters()->get('category_id', 0);
        $categoryId = explode(':', $category)[0];

        return Category::findOrNew($categoryId);
    }

    /**
     * Menu type relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menuType()
    {
        return $this->belongsTo(Lookup::class, 'type', 'key');
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
                    'title' => $parent->present()->indentedTitle(0),
                    'id'    => $parent->id,
                ];
            }
        } else {
            foreach ($root->getDescendants() as $parent) {
                $items[] = [
                    'title' => $parent->present()->indentedTitle(0),
                    'id'    => $parent->id,
                ];
            }
        }

        return array_pluck($items, 'title', 'id');
    }

    /**
     * Check if the menu has the given widget.
     *
     * @param mixed $widget
     * @return bool
     */
    public function hasWidget($widget)
    {
        if ($widget instanceof Model) {
            $widget = $widget->id;
        }

        return $this->widgets()->where('widget_id', $widget)->exists();
    }

    /**
     * Get related widgets.
     *
     * @return mixed
     */
    public function widgets()
    {
        return $this->belongsToMany(Widget::class, 'widget_menu')->withoutGlobalScope('menu_assignment');
    }

    /**
     * Check if the menu is currently selected/active.
     *
     * @return bool
     */
    public function isActive()
    {
        return request()->getRequestUri() === '/' . $this->present()->url();
    }
}

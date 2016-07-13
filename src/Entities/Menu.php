<?php

namespace Yajra\CMS\Entities;

use Baum\Node;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Yajra\Acl\Models\Permission;
use Yajra\Auditable\AuditableTrait;
use Yajra\CMS\Entities\Traits\CanRequireAuthentication;
use Yajra\CMS\Entities\Traits\HasOrder;
use Yajra\CMS\Entities\Traits\HasParameters;
use Yajra\CMS\Entities\Traits\PublishableTrait;
use Yajra\CMS\Presenters\MenuPresenter;

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
 * @property int navigation_id
 * @property int extension_id
 */
class Menu extends Node
{
    use PresentableTrait, PublishableTrait, CanRequireAuthentication;
    use AuditableTrait, HasParameters, HasOrder;

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
        'published',
        'parent_id',
        'authenticated',
        'authorization',
        'parameters',
        'extension_id',
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
        $nodes = $root->descendants();
        if ($this->exists) {
            $nodes->where('navigation_id', $this->navigation_id)->where('id', '<>', $this->id);
        }

        foreach ($nodes->get() as $node) {
            foreach ($node->getDescendantsAndSelf()->toHierarchy() as $menu) {
                $this->appendMenu($menu, $items);
            }
        }

        return array_pluck($items, 'title', 'id');
    }

    /**
     * @param \Baum\Node $node
     * @param array $items
     * @return array
     */
    protected function appendMenu($node, &$items)
    {
        $items[] = [
            'title' => $node->present()->indentedTitle(),
            'id'    => $node->id,
        ];

        if (count($node->children)) {
            foreach ($node->children as $child) {
                foreach ($child->getDescendantsAndSelf()->toHierarchy() as $menu) {
                    $this->appendMenu($menu, $items);
                }
            }
        }
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
        $url  = url($this->present()->url());
        $path = request()->path();

        return $url == request()->url() || $url == $path || url($url, [], true) == url($path, [], true);
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

<?php

namespace Yajra\CMS\Entities;

use Yajra\CMS\Contracts\Cacheable;
use Yajra\CMS\Entities\Traits\PublishableTrait;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

/**
 * @property int id
 * @property bool published
 * @property \Illuminate\Database\Eloquent\Collection menus
 * @property string type
 */
class Navigation extends Model implements Cacheable
{
    use AuditableTrait, PublishableTrait;

    /**
     * @var string
     */
    protected $table = 'navigation';

    /**
     * @var array
     */
    protected $fillable = ['title', 'type', 'published'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Menu
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Get list of keys used for caching.
     *
     * @return array
     */
    public function getCacheKeys()
    {
        return [
            'navigation.published',
            'navigation.all',
        ];
    }
}

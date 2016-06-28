<?php

namespace Yajra\CMS\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string url
 * @property int id
 * @property string type
 * @property string category
 * @property string name
 */
class FileAsset extends Model
{
    /**
     * @var string
     */
    protected $table = 'file_assets';

    /**
     * @var array
     */
    protected $fillable = ['name', 'type', 'category', 'url'];
}

<?php

namespace Yajra\CMS\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string url
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

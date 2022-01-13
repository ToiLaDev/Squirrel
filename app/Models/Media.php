<?php

namespace App\Models;

use App\Services\Media\MediaService;
use App\Traits\CausesActivityTrait;
use App\Traits\LogActivityTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Base
 * @package App
 * @method static Media find($value)
 */

class Media extends Base
{
    use SoftDeletes, LogActivityTrait, CausesActivityTrait;

    protected $table = 'medias';

    protected $fillable = ['name', 'file_name', 'collection_name', 'mime_type', 'size', 'md5', 'sha1', 'disk', 'properties', 'conversions', 'owner_id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'properties' => 'array',
        'conversions' => 'array',
    ];

    protected $hidden = ['owner_id'];

    protected $appends = ['url', 'thumb'];

    public function owner()
    {
        return $this->belongsTo(Employee::class, 'owner_id');
    }

    public function folder()
    {
        return $this->belongsTo(Media::class, 'folder_id');
    }

    public function getUrlAttribute() {
        return MediaService::media($this)->url();
    }

    public function getThumbAttribute() {
        return MediaService::media($this)->thumb();
    }
}

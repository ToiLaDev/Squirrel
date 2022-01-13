<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extend extends Model {

    protected $table = 'extends';
    public $timestamps = false;

    protected $fillable = [
        'key',
        'value'
    ];

    public function extendable()
    {
        return $this->morphTo();
    }

    public function getValueAttribute($value)
    {
        return unserialize($value);
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = serialize(is_int($value)?(int)$value:$value);
    }
}

<?php

namespace App\Models;


use App\Traits\CausesActivityTrait;
use App\Traits\LogActivityTrait;

class Setting extends Base
{
    use LogActivityTrait, CausesActivityTrait;

    protected $table = 'settings';
    public $timestamps = false;

    protected $fillable = ['key', 'type', 'value'];

    public function getValueAttribute($value)
    {
        return unserialize($value);
    }

    public function setValueAttribute($value)
    {
        if (is_numeric($value)) {
            if (preg_match("/^[1-9]{1}[0-9]+/", $value)) {
                $value = (int)$value;
            } elseif (preg_match("/^([0-9]{1}|[1-9]+)(\.|e)[0-9]+/", $value)) {
                $value = (double)$value;
            }
        }
        $this->attributes['value'] = serialize($value);
    }
}

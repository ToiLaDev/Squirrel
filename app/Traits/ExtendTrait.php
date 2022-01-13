<?php

namespace App\Traits;

use App\Models\Extend;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Str;

trait ExtendTrait
{

    private $extendsVal = [];
    private $extendsChanged = [];
    private $extendsLoaded = false;

    protected static function booted()
    {
        static::saved(function ($model) {
            $model->saveExtend();
        });
        static::forceDeleted(function ($model) {
            $model->destroyExtend();
        });
    }

    public function extends()
    {
        return $this->morphMany(Extend::class, 'extendable');
    }

    private function saveExtend() {
        $changed = [];
        $deleted = [];
        foreach ($this->extendsChanged as $key => $change) {
            if ($change) {
                $changed[] = $this->extendsVal[$key];
            }
            else {
                $deleted[] = $key;
            }
        }

        if (!empty($deleted)) {
            $this->extends()->whereIn('key', $deleted)->delete();
        }
        if (!empty($changed)) {
            $this->extends()->saveMany($changed);
        }
        unset($changed);
        unset($deleted);
    }

    private function destroyExtend() {
        $this->extends()->delete();
    }

    private function initExtend() {
        $this->extendsLoaded = true;
        $this->extendsVal = $this->extends->keyBy('key')->all();
    }

    private function setExtend($key, $value)
    {
        if (!$this->extendsLoaded) {
            $this->initExtend();
        }

        if (!isset($this->extendsVal[$key])) {
            $this->extendsChanged[$key] = true;
            $this->extendsVal[$key] = new Extend([
                'key' => $key,
                'value' => $value
            ]);
        }
        else if (!isset($this->extendsVal[$key]) || isset($this->extendsVal[$key]) && $this->extendsVal[$key]->value != $value) {
            $this->extendsChanged[$key] = true;
            $this->extendsVal[$key]->value = $value;
        }
    }

    private function deleteExtend($key)
    {
        $this->extendsChanged[$key] = false;
        unset($this->extendsVal[$key]);
    }

    private function getExtend($key)
    {
        if (!$this->extendsLoaded) {
            $this->initExtend();
        }

        if (isset($this->extendsVal[$key]))
        {
            return $this->extendsVal[$key]->value;
        }
        else {
            return;
        }
    }

    public function getAttribute($key)
    {
        if (! $key) {
            return;
        }

        if (Str::startsWith($key, 'extend_')) {
            return $this->getExtend(Str::after($key, 'extend_'));
        }

        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        if (Str::startsWith($key, 'extend_')) {
            $this->setExtend(Str::after($key, 'extend_'), $value);
        } else {
            parent::setAttribute($key, $value);
        }
    }

    public function __unset($key)
    {
        if (Str::startsWith($key, 'extend_')) {
            $this->deleteExtend(Str::after($key, 'extend_'));
        } else {
            parent::__unset($key);
        }
    }

    public function scopeWhereExtend(EloquentBuilder $query, $key, $value) {
        return $query->whereHas('extends' ,function ($q) use ($key, $value) {
            $q->where('key', preg_replace('/^extend_/', '',$key));
            $q->where('value', serialize(is_int($value)?(int)$value:$value));
        });
    }

}

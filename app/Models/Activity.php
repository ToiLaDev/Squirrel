<?php namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class Activity extends Base
{
    protected $table = 'activities';

    const UPDATED_AT = null;

    protected $casts = [
        'properties' => 'collection',
    ];

    public function subject()
    {
        return $this->morphTo()->withTrashed();
    }

    public function causer()
    {
        return $this->morphTo();
    }

    public function getExtraProperty(string $propertyName)
    {
        return Arr::get($this->properties->toArray(), $propertyName);
    }

    public function changes()
    {
        if (! $this->properties instanceof Collection) {
            return new Collection();
        }

        return $this->properties->only(['attributes', 'old']);
    }

    public function getChangesAttribute(): Collection
    {
        return $this->changes();
    }

    public function scopeInLog(Builder $query, ...$logNames)
    {
        if (is_array($logNames[0])) {
            $logNames = $logNames[0];
        }

        return $query->whereIn('type', $logNames);
    }

    public function scopeCausedBy(Builder $query, Model $causer)
    {
        return $query
            ->where('causer_type', $causer->getMorphClass())
            ->where('causer_id', $causer->getKey());
    }

    public function scopeForSubject(Builder $query, Model $subject)
    {
        return $query
            ->where('subject_type', $subject->getMorphClass())
            ->where('subject_id', $subject->getKey());
    }
}

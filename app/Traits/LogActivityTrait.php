<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

trait LogActivityTrait
{
    public static function bootLogActivityTrait() {
        if (empty(static::$logActivityEvents) || in_array('created', static::$logActivityEvents)) {
            static::created(function($model) {
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($model)
                    ->useLog('model created')
                    ->log('');
            });
        }

        if (empty(static::$logActivityEvents) || in_array('updated', static::$logActivityEvents)) {
            static::updated(function($model) {
                if ($model->wasChanged()) {
                    $changes = $model->getChanges();
                    $properties = [];

                    unset($changes['deleted_at']);
                    unset($changes['created_at']);
                    unset($changes['updated_at']);

                    foreach ($changes as $key => $val) {
                        $properties[$key] = [
                            'old'   => $model->getOriginal($key),
                            'new'   => $val
                        ];
                    }

                    activity()
                        ->causedBy(Auth::user())
                        ->performedOn($model)
                        ->withProperties($properties)
                        ->useLog('model updated')
                        ->log('');
                }
            });
        }

        if (empty(static::$logActivityEvents) || in_array('deleted', static::$logActivityEvents)) {
            static::deleted(function($model) {
                if ($model->trashed()){
                    activity()
                        ->causedBy(Auth::user())
                        ->performedOn($model)
                        ->useLog('model soft deleted')
                        ->log('');
                } else {
                    activity()
                        ->causedBy(Auth::user())
                        ->performedOn($model)
                        ->withProperties($model->toArray())
                        ->useLog('model deleted')
                        ->log('');
                }
            });
        }

        if (empty(static::$logActivityEvents) || in_array('restored', static::$logActivityEvents)) {
            try {
                static::restored(function ($model) {
                    activity()
                        ->causedBy(Auth::user())
                        ->performedOn($model)
                        ->useLog('model restored')
                        ->log('');
                });
            } catch (\Exception $exception) {

            }
        }
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}

<?php

namespace App\Traits;

use App\Models\Cast;

trait CastTrait
{

    public static function bootCastTrait() {
        static::deleted(function($model) {
            if ($model->trashed()){
                $model->cast()->update([
                    'deleted_at' => $model->freshTimestampString()
                ]);
            } else {
                $model->cast()->delete();
            }
        });

        try {
            static::restored(function ($model) {
                $model->cast()->update([
                    'deleted_at' => null
                ]);
            });
        } catch (\Exception $exception) {

        }
    }

    public function cast()
    {
        return $this->morphOne(Cast::class, 'castable');
    }

    public function setCast($slug)
    {
        $this->cast()->updateOrCreate([], ['slug' => $slug]);
    }

    public function getSlugAttribute() {
        return $this->cast ? $this->cast->slug: null;
    }
}

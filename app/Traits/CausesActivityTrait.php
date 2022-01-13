<?php

namespace App\Traits;

use App\Models\Activity;

trait CausesActivityTrait
{

    public function actions()
    {
        return $this->morphMany(Activity::class, 'causer');
    }
}

<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class ActivityHelper
{
    protected $activity;

    public function __construct()
    {
        $this->activity = new Activity;
    }

    /**
     * @param Model|null $causer
     * @return ActivityHelper
     */
    public function causedBy(Model $causer = null): self
    {
        if (empty($causer)) {
            $this->byAnonymous();
        }
        else {
            $this->activity->causer()->associate($causer);
        }
        return $this;
    }

    /**
     * @param Model $subject
     * @return ActivityHelper
     */
    public function performedOn(Model $subject): self
    {
        $this->activity->subject()->associate($subject);
        return $this;
    }

    /**
     * @param string $type
     * @return ActivityHelper
     */
    public function useLog(string $type): self
    {
        $this->activity->type = $type;
        return $this;
    }

    /**
     * @param $properties
     * @return ActivityHelper
     */
    public function withProperties($properties): self
    {
        $this->activity->properties = collect($properties);

        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return ActivityHelper
     */
    public function withProperty(string $key, $value): self
    {
        $this->activity->properties = $this->activity->properties->put($key, $value);

        return $this;
    }

    /**
     * @return ActivityHelper
     */
    public function causedByAnonymous(): self
    {
        $this->activity->causer_id = null;
        $this->activity->causer_type = null;

        return $this;
    }

    /**
     * @return ActivityHelper
     */
    public function byAnonymous(): self
    {
        return $this->causedByAnonymous();
    }

    /**
     * @param string $description
     * @return Activity
     */
    public function log(string $description): Activity
    {
        $activity = $this->activity;
        $activity->description = $description;
        $activity->save();
        $this->activity = null;

        return $activity;
    }
}

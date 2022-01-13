<?php

namespace App\Services;

class Widget
{
    protected $app;
    protected $widgets = [];

    public function __construct($app) {
        $this->app = $app;
    }

    public function register($widget, $action = null) {
        if (is_string($widget)) {
            $this->widgets[$widget] = $action;
        } else {
            foreach ($widget as $name => $action) {
                $this->widgets[$name] = $action;
            }
        }
    }

    public function has($name): bool
    {
        return in_array($name, array_keys($this->widgets));
    }

    public function display($name, $data = null)
    {
        if ($this->has($name)) {
            call_user_func($this->widgets[$name], $data);
        }
    }

}

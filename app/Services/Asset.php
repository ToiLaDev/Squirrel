<?php

namespace App\Services;

use Illuminate\Support\Collection;

class Asset
{
    protected $app;
    protected $scripts;
    protected $styles;

    public function __construct($app) {
        $this->app = $app;
        $this->scripts = collect();
        $this->styles = collect();
    }

    public function addScript($stack, $scripts) {
        foreach ((array)$scripts as $script) {
            $this->scripts->put($script, $stack);
        }
    }

    public function addStyle($stack, $styles) {
        foreach ((array)$styles as $style) {
            $this->styles->put($style, $stack);
        }
    }

    public function getScripts($stack): Collection
    {
        return $this->scripts->filter(function ($value, $key) use ($stack) {
            return $value == $stack;
        })->keys();
    }

    public function getStyles($stack): Collection
    {
        return $this->styles->filter(function ($value, $key) use ($stack) {
            return $value == $stack;
        })->keys();
    }

}

<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    public $icon;
    public $type;
    public $width;
    public $height;
    public $viewBox;
    public $fill;
    public $strokeWidth;
    public $id;
    public $class;

    public function __construct(
        $icon = null,
        $type = 'feather',
        $width = 24,
        $height = 24,
        $viewBox = '24 24',
        $fill = 'none', // currentColor, none
        $strokeWidth = 2,
        $id = null,
        $class = null
    )
    {
        $this->icon = $icon;
        $this->type = $type;
        $this->width = $width;
        $this->height = $height;
        $this->viewBox = $viewBox;
        $this->fill = $fill;
        $this->strokeWidth = $strokeWidth;
        $this->id = $id ?$id : '';
        $this->class = $class ?$class: '';
    }

    public function render()
    {
        return view('components.icon');
    }
}

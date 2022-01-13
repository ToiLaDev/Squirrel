<?php

namespace App\View\Components\Media;

use Illuminate\View\Component;

class Manager extends Component
{
    /**
     * The alert type.
     *
     * @var array
     */
    public $options = [
        'type'          => null,
        'single'        => false,
        'upload'        => true,
        'createFolder'  => true,
        'info'          => true,
        'delete'        => true,
        'rename'        => true,
        'move'          => true,
        'folder'        => null,
        'callback'      => null
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options=[])
    {
        //
        $this->options = array_merge($this->options, (array)$options);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.media.manager');
    }
}

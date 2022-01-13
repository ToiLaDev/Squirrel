<?php

namespace App\View\Components\Images;

use Illuminate\View\Component;

class Logo extends Component
{

    /**
     * The Logo size.
     *
     * @var string
     */
    public $size;

    /**
     * The Logo height.
     *
     * @var string
     */
    public $fills;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $size = 28,
        $fills = 'currentColor,currentColor'
    )
    {
        $this->size = $size;
        $this->fills = explode(',', $fills);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return baseView('components.images.logo');
    }
}

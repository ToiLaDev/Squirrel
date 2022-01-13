<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * The Form class.
     *
     * @var string
     */
    public $class;

    /**
     * The Form action.
     *
     * @var string
     */
    public $action;

    /**
     * The Form method.
     *
     * @var string
     */
    public $method;

    /**
     * The Form control.
     *
     * @var array
     */
    public $controls;

    /**
     * The Form prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The Form layout.
     *
     * @var string
     */
    public $layout;

    /**
     * The Form col.
     *
     * @var array
     */
    public $col;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $controls,
        $class = 'mt-2',
        $action = null,
        $method = 'post',
        $prefixId = 'input',
        $col = [3,9],
        $layout = 'vertical'
    )
    {
        $this->controls = $controls;
        $this->class = $class;
        $this->action = $action;
        $this->prefixId = $prefixId;
        $this->method = strtoupper($method);
        $this->layout = $layout;
        if ($this->layout == 'horizontal') {
            $this->class .= ' row';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}

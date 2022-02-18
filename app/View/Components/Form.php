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
     * The Form wrap.
     *
     * @var string
     */
    public $wrap;

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
        $layout = 'vertical',
        $col = [3,9],
        $wrap = 'col-12'
    )
    {
        $this->controls = $controls;
        $this->class = $class;
        $this->action = $action;
        $this->prefixId = $prefixId;
        $this->method = strtoupper($method);
        $this->layout = $layout;
        $this->wrap = $wrap;
        if ($this->layout == 'horizontal') {
            $this->class .= ' row';
            if (isset($fill['col'])) {
                $col = $fill['col'];
            }
            $this->col = is_string($col)?explode(',', $col):$col;
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

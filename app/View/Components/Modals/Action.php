<?php

namespace App\View\Components\Modals;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
    /**
     * The Select name.
     *
     * @var string
     */
    public $name;

    /**
     * The Select options.
     *
     * @var string
     */
    public $options;

    /**
     * The Select value.
     *
     * @var string
     */
    public $value;

    /**
     * The Select prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The Select layout.
     *
     * @var string
     */
    public $layout;

    /**
     * The Select containerClass.
     *
     * @var string
     */
    public $containerClass;

    /**
     * The Select title.
     *
     * @var string
     */
    public $title;

    /**
     * The Select col.
     *
     * @var array
     */
    public $col;

    /**
     * The Select disabled.
     *
     * @var boolean
     */
    public $disabled;

    /**
     * The Select multiple.
     *
     * @var boolean
     */
    public $multiple;

    /**
     * The Select default.
     *
     * @var string
     */
    public $default;

    /**
     * The Select class.
     *
     * @var string
     */
    public $class;

    /**
     * The Select datas.
     *
     * @var array
     */
    public $datas;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $options = null,
        $name = null,
        $title = null,
        $value = null,
        $prefixId = 'input',
        $containerClass = 'mb-2',
        $class = null,
        $datas = null,
        $layout = 'vertical',
        $col = [3,9],
        $fill = null,
        $disabled = false,
        $multiple = false,
        $default = null
    )
    {
        $this->name = $fill['name']??$name;
        $this->options = $fill['options']??$options;
        $this->title = $fill['title']??($title??name2Title($this->name));
        $this->layout = $fill['layout']??$layout;
        $this->value = $fill['value']??$value;
        $this->prefixId = $fill['prefixId']??$prefixId;
        $this->containerClass = $fill['containerClass']??$containerClass;
        $this->disabled = $fill['disabled']??$disabled;
        $this->multiple = $fill['multiple']??$multiple;
        $this->default = $fill['default']??$default;
        $this->class = $fill['class']??$class;
        $this->datas = $fill['datas']??$datas;
        if ($this->layout == 'horizontal') {
            $this->containerClass .= ' row';
            if (isset($fill['col'])) {
                $col = $fill['col'];
            }
            $this->col = is_string($col)?explode(',', $col):$col;
        }
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.modals.action');
    }
}

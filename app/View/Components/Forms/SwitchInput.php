<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class SwitchInput extends Component
{

    /**
     * The SwitchInput name.
     *
     * @var string
     */
    public $name;

    /**
     * The SwitchInput checked.
     *
     * @var boolean
     */
    public $checked;

    /**
     * The SwitchInput placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * The SwitchInput prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The SwitchInput layout.
     *
     * @var string
     */
    public $layout;

    /**
     * The SwitchInput containerClass.
     *
     * @var string
     */
    public $containerClass;

    /**
     * The SwitchInput title.
     *
     * @var string
     */
    public $title;

    /**
     * The SwitchInput col.
     *
     * @var array
     */
    public $col;

    /**
     * The SwitchInput disabled.
     *
     * @var boolean
     */
    public $disabled;

    /**
     * The SwitchInput required.
     *
     * @var boolean
     */
    public $required;

    /**
     * The SwitchInput type.
     *
     * @var string
     */
    public $type;

    /**
     * The SwitchInput iconLeft.
     *
     * @var string
     */
    public $iconLeft;

    /**
     * The SwitchInput iconRight.
     *
     * @var string
     */
    public $iconRight;

    /**
     * The SwitchInput class.
     *
     * @var string
     */
    public $class;

    /**
     * The SwitchInput datas.
     *
     * @var array
     */
    public $datas;

    /**
     * The SwitchInput fill.
     *
     * @var array
     */
    public $fill;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name = null,
        $title = null,
        $placeholder = null,
        $checked = false,
        $prefixId = 'input',
        $containerClass = 'mb-2',
        $class = null,
        $datas = null,
        $layout = 'vertical',
        $iconLeft = null,
        $iconRight = null,
        $col = [3,9],
        $fill = null,
        $type = null,
        $disabled = false,
        $required = false
    )
    {
        $this->name = $fill['name']??$name;
        $this->title = $fill['title']??($title??name2Title($this->name));
        $this->placeholder = $fill['placeholder']??$placeholder;
        $this->layout = $fill['layout']??$layout;
        $this->checked = $fill['checked']??$checked;
        $this->prefixId = $fill['prefixId']??$prefixId;
        $this->containerClass = $fill['containerClass']??$containerClass;
        $this->disabled = $fill['disabled']??$disabled;
        $this->required = $fill['required']??$required;
        $this->type = $fill['type']??$type;
        $this->iconLeft = $fill['iconLeft']??$iconLeft;
        $this->iconRight = $fill['iconRight']??$iconRight;
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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view(config('components.forms.switch-input', 'components.forms.switch-input'));
    }
}

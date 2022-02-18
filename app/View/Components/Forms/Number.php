<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Number extends Component
{

    /**
     * The Number name.
     *
     * @var string
     */
    public $name;

    /**
     * The Number value.
     *
     * @var float
     */
    public $value;

    /**
     * The Number prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The Number layout.
     *
     * @var string
     */
    public $layout;

    /**
     * The Number containerClass.
     *
     * @var string
     */
    public $containerClass;

    /**
     * The Number title.
     *
     * @var string
     */
    public $title;

    /**
     * The Number col.
     *
     * @var array
     */
    public $col;

    /**
     * The Number disabled.
     *
     * @var boolean
     */
    public $disabled;

    /**
     * The Number required.
     *
     * @var boolean
     */
    public $required;

    /**
     * The Number step.
     *
     * @var float
     */
    public $step;

    /**
     * The Number decimals.
     *
     * @var integer
     */
    public $decimals;

    /**
     * The Number min.
     *
     * @var float
     */
    public $min;

    /**
     * The Number max.
     *
     * @var float
     */
    public $max;

    /**
     * The Number downClass.
     *
     * @var string
     */
    public $downClass;

    /**
     * The Number upClass.
     *
     * @var string
     */
    public $upClass;

    /**
     * The Number downIcon.
     *
     * @var string
     */
    public $downIcon;

    /**
     * The Number upIcon.
     *
     * @var string
     */
    public $upIcon;

    /**
     * The Number prefix.
     *
     * @var string
     */
    public $prefix;

    /**
     * The Number postfix.
     *
     * @var string
     */
    public $postfix;

    /**
     * The Number class.
     *
     * @var string
     */
    public $class;

    /**
     * The Number datas.
     *
     * @var array
     */
    public $datas;

    /**
     * The Number fill.
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
        $value = 0,
        $prefixId = 'input',
        $containerClass = 'mb-2',
        $class = null,
        $datas = null,
        $layout = 'vertical',
        $downClass = 'btn btn-primary',
        $upClass = 'btn btn-primary',
        $downIcon = 'fa fa-minus',
        $upIcon = 'fa fa-plus',
        $step = 1,
        $decimals = 0,
        $min = null,
        $max = null,
        $postfix = null,
        $prefix = null,
        $col = [3,9],
        $fill = null,
        $disabled = false,
        $required = false
    )
    {
        $this->name = $fill['name']??$name;
        $this->title = $fill['title']??($title??name2Title($this->name));
        $this->layout = $fill['layout']??$layout;
        $this->value = (float)($fill['value']??$value);
        $this->prefixId = $fill['prefixId']??$prefixId;
        $this->containerClass = $fill['containerClass']??$containerClass;
        $this->disabled = $fill['disabled']??$disabled;
        $this->required = $fill['required']??$required;
        $this->step = $fill['step']??$step;
        $this->decimals = $fill['decimals']??$decimals;
        $this->min = $fill['min']??$min;
        $this->max = $fill['max']??$max;
        $this->postfix = $fill['postfix']??$postfix;
        $this->prefix = $fill['prefix']??$prefix;
        $this->downClass = $fill['downClass']??$downClass;
        $this->upClass = $fill['upClass']??$upClass;
        $this->downIcon = $fill['downIcon']??$downIcon;
        $this->upIcon = $fill['upIcon']??$upIcon;
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
        return view(config('components.forms.number', 'components.forms.number'));
    }
}

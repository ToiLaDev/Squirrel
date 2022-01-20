<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{

    /**
     * The Checkbox name.
     *
     * @var string
     */
    public $name;

    /**
     * The Checkbox value.
     *
     * @var string
     */
    public $value;

    /**
     * The Checkbox prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The Checkbox layout.
     *
     * @var string
     */
    public $layout;

    /**
     * The Checkbox containerClass.
     *
     * @var string
     */
    public $containerClass;

    /**
     * The Checkbox title.
     *
     * @var string
     */
    public $title;

    /**
     * The Checkbox col.
     *
     * @var array
     */
    public $col;

    /**
     * The Checkbox disabled.
     *
     * @var boolean
     */
    public $disabled;

    /**
     * The Checkbox multiple.
     *
     * @var boolean
     */
    public $multiple;

    /**
     * The Checkbox class.
     *
     * @var string
     */
    public $class;

    /**
     * The Checkbox datas.
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
        $multiple = false
    )
    {
        $this->name = $fill['name']??$name;
        $this->title = $fill['title']??($title??name2Title($this->name));
        $this->layout = $fill['layout']??$layout;
        $this->value = $fill['value']??$value;
        $this->prefixId = $fill['prefixId']??$prefixId;
        $this->containerClass = $fill['containerClass']??$containerClass;
        $this->disabled = $fill['disabled']??$disabled;
        $this->multiple = $fill['multiple']??$multiple;
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
        return view('components.forms.checkbox');
    }
}

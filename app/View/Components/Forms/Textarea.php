<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{

    /**
     * The Textarea name.
     *
     * @var string
     */
    public $name;

    /**
     * The Textarea value.
     *
     * @var string
     */
    public $value;

    /**
     * The Textarea placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * The Textarea layout.
     *
     * @var string
     */
    public $layout;

    /**
     * The Textarea prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The Textarea containerClass.
     *
     * @var string
     */
    public $containerClass;

    /**
     * The Textarea title.
     *
     * @var string
     */
    public $title;

    /**
     * The Textarea col.
     *
     * @var array
     */
    public $col;

    /**
     * The Textarea disabled.
     *
     * @var boolean
     */
    public $disabled;

    /**
     * The Textarea required.
     *
     * @var boolean
     */
    public $required;

    /**
     * The Textarea class.
     *
     * @var string
     */
    public $class;

    /**
     * The Textarea datas.
     *
     * @var array
     */
    public $datas;

    /**
     * The Textarea fill.
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
        $value = null,
        $prefixId = 'input',
        $placeholder = null,
        $containerClass = 'mb-2',
        $class = null,
        $datas = null,
        $layout = 'vertical',
        $col = [3,9],
        $fill = null,
        $disabled = false,
        $required = false
    )
    {
        $this->name = $fill['name']??$name;
        $this->title = $fill['title']??($title??name2Title($this->name));
        $this->placeholder = $fill['placeholder']??$placeholder;
        $this->layout = $fill['layout']??$layout;
        $this->value = $fill['value']??$value;
        $this->prefixId = $fill['prefixId']??$prefixId;
        $this->containerClass = $fill['containerClass']??$containerClass;
        $this->disabled = $fill['disabled']??$disabled;
        $this->required = $fill['required']??$required;
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
        return view('components.forms.textarea');
    }
}

<?php

namespace App\View\Components\Modals;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
       /**
     * The Input type.
     *
     * @var string
     */
    public $type;

    /**
     * The Input name.
     *
     * @var string
     */
    public $name;

    /**
     * The Input value.
     *
     * @var string
     */
    public $value;

    /**
     * The Input placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * The Input icon.
     *
     * @var string
     */
    public $icon;

    /**
     * The Input prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The Input layout.
     *
     * @var string
     */
    public $layout;

    /**
     * The Input containerClass.
     *
     * @var string
     */
    public $containerClass;

    /**
     * The Input title.
     *
     * @var string
     */
    public $title;

    /**
     * The Input col.
     *
     * @var array
     */
    public $col;

    /**
     * The Input same.
     *
     * @var string
     */
    public $same;

    /**
     * The Input slug.
     *
     * @var string
     */
    public $slug;

    /**
     * The Input disabled.
     *
     * @var boolean
     */
    public $disabled;

    /**
     * The Input required.
     *
     * @var boolean
     */
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name = null,
        $title = null,
        $type = 'text',
        $icon = null,
        $placeholder = null,
        $value = null,
        $prefixId = 'input',
        $containerClass = 'mb-2',
        $layout = 'vertical',
        $col = [3,9],
        $fill = null,
        $same = null,
        $slug = null,
        $disabled = false,
        $required = false
    )
    {
        $this->name = $fill['name']??$name;
        $this->title = $fill['title']??($title??name2Title($this->name));
        $this->type = $fill['type']??$type;
        $this->placeholder = $fill['placeholder']??$placeholder;
        $this->layout = $fill['layout']??$layout;
        $this->icon = $fill['icon']??$icon;
        $this->value = $fill['value']??$value;
        $this->prefixId = $fill['prefixId']??$prefixId;
        $this->containerClass = $fill['containerClass']??$containerClass;
        $this->same = $fill['same']??$same;
        $this->slug = $fill['slug']??$slug;
        $this->disabled = $fill['disabled']??$disabled;
        $this->required = $fill['required']??$required;
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

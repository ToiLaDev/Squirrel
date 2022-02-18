<?php

namespace App\View\Components\Employee;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select2 extends Component
{

    /**
     * The Select2 name.
     *
     * @var string
     */
    public $name;

    /**
     * The Select2 value.
     *
     * @var string
     */
    public $value;

    /**
     * The Select2 prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The Select2 layout.
     *
     * @var string
     */
    public $layout;

    /**
     * The Select2 containerClass.
     *
     * @var string
     */
    public $containerClass;

    /**
     * The Select2 title.
     *
     * @var string
     */
    public $title;

    /**
     * The Select2 col.
     *
     * @var array
     */
    public $col;

    /**
     * The Select2 disabled.
     *
     * @var boolean
     */
    public $disabled;

    /**
     * The Select2 multiple.
     *
     * @var boolean
     */
    public $multiple;

    /**
     * The Select2 default.
     *
     * @var string
     */
    public $default;

    /**
     * The Select2 class.
     *
     * @var string
     */
    public $class;

    /**
     * The Select2 placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * The Select2 wrap.
     *
     * @var string
     */
    public $wrap;

    /**
     * The Select2 fill.
     *
     * @var array
     */
    public $fill;

    /**
     * The Select2 role.
     *
     * @var mixed
     */
    public $role;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name = null,
        $title = null,
        $value = null,
        $placeholder = null,
        $prefixId = 'input',
        $containerClass = 'mb-2',
        $wrap = '<div class="position-relative"></div>',
        $class = null,
        $layout = 'vertical',
        $col = [3,9],
        $fill = null,
        $disabled = false,
        $multiple = false,
        $default = null,
        $role = []
    )
    {
        $this->name = $fill['name']??$name;
        $this->title = $fill['title']??($title??name2Title($this->name));
        $this->layout = $fill['layout']??$layout;
        $this->placeholder = $fill['placeholder']??$placeholder;
        $this->wrap = $fill['wrap']??$wrap;
        $this->value = $fill['value']??$value;
        $this->prefixId = $fill['prefixId']??$prefixId;
        $this->containerClass = $fill['containerClass']??$containerClass;
        $this->disabled = $fill['disabled']??$disabled;
        $this->multiple = $fill['multiple']??$multiple;
        $this->default = $fill['default']??$default;
        $this->class = $fill['class']??$class;
        $this->role = $fill['role']??$role;
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
        return view('components.employee.select2');
    }
}

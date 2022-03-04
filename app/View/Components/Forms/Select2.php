<?php

namespace App\View\Components\Forms;

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
     * The Select2 options.
     *
     * @var string
     */
    public $options;

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
     * The Select2 datas.
     *
     * @var array
     */
    public $datas;

    /**
     * The Select2 remote.
     *
     * @var string
     */
    public $remote;

    /**
     * The Select2 remoteDelay.
     *
     * @var integer
     */
    public $remoteDelay;

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
     * The Select2 minimumInputLength.
     *
     * @var integer
     */
    public $minimumInputLength;

    /**
     * The Select2 maximumInputLength.
     *
     * @var integer
     */
    public $maximumInputLength;

    /**
     * The Select2 templateResult.
     *
     * @var string
     */
    public $templateResult;

    /**
     * The Select2 templateSelection.
     *
     * @var string
     */
    public $templateSelection;

    /**
     * The Select2 fill.
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
        $options = null,
        $name = null,
        $title = null,
        $value = null,
        $placeholder = null,
        $prefixId = 'input',
        $containerClass = 'mb-2',
        $wrap = '<div class="position-relative"></div>',
        $class = null,
        $datas = null,
        $layout = 'vertical',
        $col = [3,9],
        $fill = null,
        $disabled = false,
        $multiple = false,
        $default = null,
        $remote = null,
        $templateResult = null,
        $templateSelection = null,
        $remoteDelay = 250,
        $minimumInputLength = 0,
        $maximumInputLength = 0
    )
    {
        $this->name = $fill['name']??$name;
        $this->options = $fill['options']??$options;
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
        $this->datas = $fill['datas']??$datas;
        $this->remote = $fill['remote']??$remote;
        $this->remoteDelay = $fill['remoteDelay']??$remoteDelay;
        $this->minimumInputLength = $fill['minimumInputLength']??$minimumInputLength;
        $this->maximumInputLength = $fill['maximumInputLength']??$maximumInputLength;
        $this->templateResult = $fill['templateResult']??$templateResult;
        $this->templateSelection = $fill['templateSelection']??$templateSelection;
        if ($this->layout == 'horizontal') {
            $this->containerClass .= ' row';
            if (isset($fill['col'])) {
                $col = $fill['col'];
            }
            $this->col = is_string($col)?explode(',', $col):$col;
        }
        if (
            empty($this->options)
            && !empty($this->remote)
            && !empty($this->value)
        ) {
            $this->value = (array)$this->value;
            foreach ($this->value as $item) {
                $this->options[] = $item;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.forms.select2');
    }
}

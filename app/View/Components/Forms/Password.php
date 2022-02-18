<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Password extends Component
{

    /**
     * The Password name.
     *
     * @var string
     */
    public $name;

    /**
     * The Password value.
     *
     * @var string
     */
    public $value;

    /**
     * The Password placeholder.
     *
     * @var string
     */
    public $placeholder;

    /**
     * The Password prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The Password layout.
     *
     * @var string
     */
    public $layout;

    /**
     * The Password containerClass.
     *
     * @var string
     */
    public $containerClass;

    /**
     * The Password title.
     *
     * @var string
     */
    public $title;

    /**
     * The Password col.
     *
     * @var array
     */
    public $col;

    /**
     * The Password disabled.
     *
     * @var boolean
     */
    public $disabled;

    /**
     * The Password required.
     *
     * @var boolean
     */
    public $required;

    /**
     * The Password random.
     *
     * @var boolean
     */
    public $random;

    /**
     * The Password randomLength.
     *
     * @var integer
     */
    public $randomLength;

    /**
     * The Password randomCharset.
     *
     * @var string
     */
    public $randomCharset;

    /**
     * The Password fill.
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
        $value = null,
        $prefixId = 'input',
        $containerClass = 'mb-2',
        $layout = 'vertical',
        $col = [3,9],
        $fill = null,
        $disabled = false,
        $required = false,
        $random = false,
        $randomLength = 8,
        $randomCharset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()'
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
        $this->random = $fill['random']??$random;
        $this->randomLength = $fill['randomLength']??$randomLength;
        $this->randomCharset = $fill['randomCharset']??$randomCharset;
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
        return view('components.forms.password');
    }
}

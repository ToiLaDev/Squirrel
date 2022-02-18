<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Quill extends Component
{

    /**
     * The Quill name.
     *
     * @var string
     */
    public $name;

    /**
     * The Quill value.
     *
     * @var string
     */
    public $value;

    /**
     * The Quill prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The Quill containerClass.
     *
     * @var string
     */
    public $containerClass;

    /**
     * The Quill title.
     *
     * @var string
     */
    public $title;

    /**
     * The Quill fill.
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
        $containerClass = 'mb-2',
        $fill = null
    )
    {
        $this->name = $fill['name']??$name;
        $this->title = $fill['title']??($title??name2Title($this->name));
        $this->value = $fill['value']??$value;
        $this->prefixId = $fill['prefixId']??$prefixId;
        $this->containerClass = $fill['containerClass']??$containerClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.forms.quill');
    }
}

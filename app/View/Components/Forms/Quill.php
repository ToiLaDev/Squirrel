<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Quill extends Component
{

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
     * The Input prefixId.
     *
     * @var string
     */
    public $prefixId;

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

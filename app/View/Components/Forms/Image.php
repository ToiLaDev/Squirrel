<?php

namespace App\View\Components\Forms;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Image extends Component
{

    /**
     * The Image name.
     *
     * @var string
     */
    public $name;

    /**
     * The Image value.
     *
     * @var string
     */
    public $value;

    /**
     * The Image prefixId.
     *
     * @var string
     */
    public $prefixId;

    /**
     * The Image layout.
     *
     * @var string
     */
    public $layout;

    /**
     * The Image containerClass.
     *
     * @var string
     */
    public $containerClass;

    /**
     * The Image title.
     *
     * @var string
     */
    public $title;

    /**
     * The Image collection.
     *
     * @var string
     */
    public $collection;

    /**
     * The Image multiple.
     *
     * @var boolean
     */
    public $multiple;

    /**
     * The Image col.
     *
     * @var array
     */
    public $col;

    /**
     * The Image required.
     *
     * @var boolean
     */
    public $required;

    /**
     * The Image url.
     *
     * @var string
     */
    public $url;

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
        $layout = 'vertical',
        $collection = null,
        $col = [3,9],
        $fill = null,
        $required = false,
        $multiple = false
    )
    {
        $this->name = $fill['name']??$name;
        $this->title = $fill['title']??($title??name2Title($this->name));
        $this->layout = $fill['layout']??$layout;
        $this->value = $fill['value']??$value;
        $this->prefixId = $fill['prefixId']??$prefixId;
        $this->containerClass = $fill['containerClass']??$containerClass;
        $this->collection = $fill['collection']??$collection;
        $this->required = $fill['required']??$required;
        $this->multiple = $fill['multiple']??$multiple;
        if ($this->layout == 'horizontal') {
            $this->containerClass .= ' row';
            if (isset($fill['col'])) {
                $col = $fill['col'];
            }
            $this->col = is_string($col)?explode(',', $col):$col;
        }
        $this->url = route('admin.media.window', ['type'=>'image', 'collection_name' => $this->collection]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.forms.image');
    }
}

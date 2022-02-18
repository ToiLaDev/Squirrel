<?php

namespace App\View\Components\Forms;

use App\Models\Employee;
use Illuminate\View\Component;
use Spatie\Permission\Models\Role;

class Permission extends Component
{

    /**
     * The Permission name.
     *
     * @var string
     */
    public $name;

    /**
     * The Permission title.
     *
     * @var string
     */
    public $title;

    /**
     * The Permission model.
     *
     * @var Employee|Role
     */
    public $model;

    /**
     * The Permission modules.
     *
     * @var array
     */
    public $modules;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name = 'permissions',
        $title = 'Permission',
        $model = null
    )
    {
        //
        $this->name = $name;
        $this->title = $title;
        $this->model = $model;
        $this->modules = config('permission.modules');

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.permission');
    }
}

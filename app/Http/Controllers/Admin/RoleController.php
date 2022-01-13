<?php namespace App\Http\Controllers\Admin;

use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public $permissions = [
        'role.view' => ['index'],
        'role.create' => ['create', 'store'],
        'role.edit' => ['edit', 'update'],
        'role.delete' => ['destroy']
    ];

    public $breadcrumbs = [
        ['link' => 'javascript:void(0)', 'name' => 'System']
    ];

    public $mainRouteName = 'admin.roles.index';

    public $roleService;

    public function __construct(RoleService $roleService)
    {
        parent::__construct();
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        $this->breadcrumb('Roles');

        $roles = $this->roleService->all();

        $modules = config('permission.modules');

        return view('admin.system.role.list', [
            'roles' => $roles,
            'modules' => $modules
        ]);
    }

    public function store(Request $request)
    {
        $role = $this->roleService->createFromRequest($request);

        return $this->storeResponse($role);
    }

    public function edit(int $id) {
        //if ($id == 1) return abort(404);

        $this->breadcrumb('Roles')->withButtonMain();

        $roles = $this->roleService->all();
        $role = $this->roleService->find($id);

        $modules = config('permission.modules');

        return view('admin.system.role.edit', [
            'roles' => $roles,
            'role' => $role,
            'modules' => $modules
        ]);
    }

    public function update(int $id, Request $request)
    {
        $role = $this->roleService->updateFromRequest($id, $request);

        return $this->updateResponse($role);
    }
}

<?php

namespace App\Forms;

use App\Services\RoleService;

class RoleForm
{
    private $roleService;

    public function __construct(RoleService $roleService) {
        $this->roleService = $roleService;
    }

    public function create() {
        $action = route('admin.roles.store');
        $controls = [
            'name' => [
                'required' => true,
                'placeholder' => 'Role Name'
            ],
            'permissions' => [
                'type' => 'permission',
                'title' => 'Direct Permission',
                'wrap' => 'col-12'
            ],
        ];

        return view('use.form', [
            'action' => $action,
            'wrap' => 'col-12',
            'controls' => $controls
        ]);
    }

    public function edit($role)
    {
        if (is_numeric($role)) {
            $role = $this->roleService->find($role);
        }
        if (empty($role)) {
            return '';
        } else {
            $action = route('admin.roles.update', $role->id);
            $controls = [
                'name' => [
                    'required' => true,
                    'placeholder' => 'Role Name',
                    'value' => $role->name
                ],
                'permissions' => [
                    'type' => 'permission',
                    'wrap' => 'col-12',
                    'model' => $role
                ],
            ];

            return view('use.form', [
                'action' => $action,
                'method' => 'put',
                'wrap' => 'col-12',
                'controls' => $controls
            ]);
        }
    }
}
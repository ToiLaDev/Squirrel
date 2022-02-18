<?php

namespace App\Forms;

use App\Services\EmployeeService;
use Illuminate\Support\Facades\Auth;

class EmployeeForm
{
    private $employeeService;

    public function __construct(EmployeeService $employeeService) {
        $this->employeeService = $employeeService;
    }

    public function create() {
        $action = route('admin.employees.store');
        $controls = [
//            'avatar' => [
//                'type' => 'image',
//                'wrap' => 'col-12'
//            ],
            'username' => [
                'required' => true
            ],
            'first_name' => [
                'required' => true
            ],
            'last_name' => [
                'required' => true
            ],
            'email' => [
                'type' => 'email',
                'required' => true
            ],
            'phone' => [],
            'status' => [
                'type' => 'select',
                'options' => [
                    [
                        'value'=>1,
                        'title'=>__('Active')
                    ],
                    [
                        'value'=>0,
                        'title'=>__('Inactive')
                    ]
                ]
            ],
            'role' => [
                'type' => 'role',
                'disabled' => Auth::user()->cannot('employee.permission'),
                'multiple' => true,
                'placeholder' => '-- Choose Role --'
            ],
            'password' => [
                'required' => true,
                'type' => 'password'
            ],
            'password_confirmation' => [
                'required' => true,
                'type' => 'password'
            ],
            'permissions' => [
                'type' => 'permission',
                'title' => 'Direct Permission',
                'wrap' => 'col-12'
            ],
        ];

        return view('use.form', [
            'action' => $action,
            'controls' => $controls
        ]);
    }

    public function edit($employee)
    {
        if (is_numeric($employee)) {
            $employee = $this->employeeService->find($employee);
        }
        if (empty($employee)) {
            return '';
        } else {
            $action = route('admin.employees.update', $employee->id);
            $controls = [
//            'avatar' => [
//                'type' => 'image',
//                'wrap' => 'col-12'
//            ],
                'username' => [
                    'required' => true,
                    'value' => $employee->username
                ],
                'first_name' => [
                    'required' => true,
                    'value' => $employee->first_name
                ],
                'last_name' => [
                    'required' => true,
                    'value' => $employee->last_name
                ],
                'email' => [
                    'type' => 'email',
                    'required' => true,
                    'value' => $employee->email
                ],
                'phone' => [
                    'value' => $employee->phone
                ],
                'status' => [
                    'type' => 'select',
                    'value' => $employee->status,
                    'options' => [
                        [
                            'value'=>1,
                            'title'=>__('Active')
                        ],
                        [
                            'value'=>0,
                            'title'=>__('Inactive')
                        ]
                    ]
                ],
                'role' => [
                    'type' => 'role',
                    'disabled' => Auth::user()->cannot('employee.permission'),
                    'multiple' => true,
                    'placeholder' => '-- Choose Role --',
                    'value' => $employee->roles->pluck('id')->all()
                ],
                'password' => [
                    'type' => 'password'
                ],
                'password_confirmation' => [
                    'type' => 'password'
                ],
                'permissions' => [
                    'type' => 'permission',
                    'title' => 'Direct Permission',
                    'wrap' => 'col-12',
                    'model' => $employee
                ],
            ];

            return view('use.form', [
                'action' => $action,
                'method' => 'put',
                'controls' => $controls
            ]);
        }
    }
}
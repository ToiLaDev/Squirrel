<?php

namespace App\DataTables;

use App\Repositories\EmployeeRepository;

class EmployeesDataTable extends BaseDataTable
{
    protected $exportColumns = [
        ['data' => 'id', 'title' => 'ID'],
        ['data' => 'username', 'title' => 'Username'],
        ['data' => 'first_name', 'title' => 'First Name'],
        ['data' => 'last_name', 'title' => 'Last Name'],
        ['data' => 'email', 'title' => 'Email'],
        ['data' => 'phone', 'title' => 'Phone Number']
    ];

    protected $showButtons = ['create', 'excel', 'reload'];

    protected function columns(): array
    {
        return [
            'username' => [
                'title' => 'User',
                'raw' => 'Admin::datatable.user-info'
            ],
            'email' => [],
            'phone' => [
                'title' => 'Phone Number'
            ],
            '_role' => [
                'raw' => 'Admin::system.employee.role'
            ],
            'status' => [
                'raw' => 'Admin::system.employee.status'
            ],
            'action' => [
                'raw' => 'Admin::system.employee.action',
                'width' => 80,
                'addClass' => 'text-center'
            ]
        ];
    }

    public function query(EmployeeRepository $repository)
    {
        return $repository->newQuery();
    }
}

<?php

namespace App\DataTables;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EmployeesDataTable extends DataTable
{
    protected $exportColumns = [
        ['data' => 'id', 'title' => 'ID'],
        ['data' => 'username', 'title' => 'Username'],
        ['data' => 'first_name', 'title' => 'First Name'],
        ['data' => 'last_name', 'title' => 'Last Name'],
        ['data' => 'email', 'title' => 'Email'],
        ['data' => 'phone', 'title' => 'Phone Number']
    ];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('info', 'Admin::datatable.user-info')
            ->addColumn('role', 'Admin::system.employee.role')
            ->addColumn('status', 'Admin::system.employee.status')
            ->addColumn('action', 'Admin::system.employee.action')
            ->rawColumns(['info', 'role', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param EmployeeRepository $employeeRepo
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(EmployeeRepository $employeeRepo)
    {
        return $employeeRepo->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('employees-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' .
                        '<"col-lg-12 col-xl-3"l>' .
                        '<"col-lg-12 col-xl-9 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap me-1"<"me-1"f>B>>' .
                        '>t' .
                        '<"d-flex justify-content-between mx-2 row mb-1"' .
                        '<"col-sm-12 col-md-6"i>' .
                        '<"col-sm-12 col-md-6"p>' .
                        '>')
                    ->buttons(
                        Button::make([
                            'extend' => 'create',
                            'className' => 'btn-primary',
                            'text' => __('Add New')
                        ]),
                        Button::make([
                            'extend' => 'excel',
                            'className' => 'btn-success',
                            'text' => __('Export')
                        ]),
                        Button::make([
                            'extend' => 'reload',
                            'className' => 'btn-secondary',
                            'text' => __('Reload')
                        ])
                    )
                    ->language([
                        'emptyTable' => __('No data available in table'),
                        'info' => __('Showing _START_ to _END_ of _TOTAL_ entries'),
                        'infoEmpty' => __('Showing 0 to 0 of 0 entries'),
                        'loadingRecords' => __('Loading...'),
                        'processing' => __('Processing...'),
                        'search' => __('Search:'),
                        'paginate' => [
                            'first' => __('First'),
                            'last' => __('Last'),
                            'next' => ' ',//__('Next'),
                            'previous' => ' ',//__('Previous'),
                        ],
                        'lengthMenu' => __('Show _MENU_ entries')
                    ])
            ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('info')
                ->title(__('User')),
//            Column::make('id')
//                ->title(__('ID')),
//            Column::make('username')
//                ->title(__('Username')),
//            Column::make('full_name')
//                ->title(__('Full Name')),
            Column::make('email')
                ->title(__('Email')),
            Column::make('phone')
                ->title(__('Phone Number')),
            Column::computed('role')
                ->title(__('Role')),
            Column::computed('status')
                ->title(__('Status')),
            Column::computed('action')
                ->title(__('Actions'))
                ->width(80)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Employees_' . date('YmdHis');
    }
}

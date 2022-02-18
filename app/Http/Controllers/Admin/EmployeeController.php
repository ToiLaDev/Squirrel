<?php namespace App\Http\Controllers\Admin;

use App\DataTables\EmployeesDataTable;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public $permissions = [
        'employee.view' => ['index', 'search'],
        'employee.create' => ['create', 'store'],
        'employee.edit' => ['edit', 'update'],
        'employee.delete' => ['destroy']
    ];

    public $breadcrumbs = [
        ['link' => 'javascript:void(0)', 'name' => 'System']
    ];

    public $mainRouteName = 'admin.employees.index';

    public $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        parent::__construct();
        $this->employeeService = $employeeService;
    }

    public function index(EmployeesDataTable $dataTable)
    {
        $this->breadcrumb('Employees');

        return $dataTable->render('Admin::system.employee.list');
    }

    public function create() {

        $this->breadcrumb('Employees')->withButtonMain();

        $modules = config('permission.modules');

        return view('Admin::system.employee.create', [
            'modules' => $modules
        ]);
    }

    public function edit(int $id) {
//        if ($id == 1) return abort(404);
        $this->breadcrumb('Employees')->withButtonMain();

        $employee = $this->employeeService->find($id);

        $modules = config('permission.modules');

        return view('Admin::system.employee.edit', [
            'employee' => $employee,
            'modules' => $modules
        ]);
    }

    public function store(Request $request)
    {
        $employee = $this->employeeService->createFromRequest($request);

        return $this->storeResponse($employee);
    }

    public function update(int $id, Request $request)
    {
        $employee = $this->employeeService->updateFromRequest($id, $request);

        return $this->updateResponse($employee);
    }

    public function destroy(int $id, Request $request) {

        if ($id == 1) return back();

        //$this->employeeService->delete($id);

        return $this->deleteResponse();
    }

    public function search(Request $request) {
        $employees = $this->employeeService->searchFromRequest($request);
        return $this->success($employees);
    }
}

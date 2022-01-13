<?php namespace App\Http\Controllers\Admin;

use App\Services\EmployeeService;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public $breadcrumbs = [
        ['link' => "javascript:void(0)", 'name' => 'Account Setting']
    ];

    public $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        parent::__construct();
        $this->employeeService = $employeeService;
    }

    public function profile()
    {
        $this->breadcrumb('Account');

        return view('Admin::account.profile');
    }

    public function security()
    {
        $this->breadcrumb('Security');

        return view('Admin::account.security');
    }

    public function notify()
    {
        $this->breadcrumb('Notifications');

        $notifySetting = $this->employeeService->notifySetting();

        return view('Admin::account.notify', [
            'notifySetting' => $notifySetting
        ]);
    }

    public function profile_update(Request $request)
    {
        $my = $this->employeeService->profileFromRequest($request, $this->admin->id);

        return $this->updateResponse($my);
    }

    public function security_update(Request $request)
    {
        if ($my = $this->employeeService->securityFromRequest($request, $this->admin->id)) {
            return $this->updateResponse($my);
        }
        else {
            return $this->errorToast('Password change failed', 200, null, ['password' => 'Password change failed']);
        }
    }

    public function notify_update(Request $request)
    {
        $my = $this->employeeService->notifyFromRequest($request, $this->admin->id);
        return $this->updateResponse($my);
    }
}

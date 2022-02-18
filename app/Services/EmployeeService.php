<?php

namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeService extends RepositoryService implements EmployeeServiceImpl
{

    public function __construct(EmployeeRepository $employeeRepo, RoleRepository $roleRepo) {
        $this->firstRepo = $employeeRepo;
        $this->secondRepo = $roleRepo;
    }

    public function allRoles()
    {
        return $this->secondAll();
    }

    public function createFromRequest($request)
    {
        $attributes = $request->only('username', 'first_name', 'last_name', 'phone', 'email', 'status', 'password');
        $role = false;
        $permissions = false;

        if ($request->user()->can('employee.permission')) {
            $role = $request->input('role', []);
            $permissions = $request->input('permissions', []);
        }

        return $this->firstRepo->create($attributes, $role, $permissions);
    }

    public function updateFromRequest(int $id, $request)
    {
        $attributes = $request->only('first_name', 'last_name', 'phone', 'email', 'status', 'password');
        $role = false;
        $permissions = false;

        if ($request->user()->can('employee.permission')) {
            $role = $request->input('role', []);
            $permissions = $request->input('permissions', []);
        }

        return $this->firstRepo->update($id, $attributes, $role, $permissions);
    }

    public function profileFromRequest($request, $id)
    {
        $attributes = $request->only(['first_name', 'last_name', 'email', 'phone', 'birthday', 'gender']);

        if ($this->firstRepo->emailExits($attributes['email'], $id)) {
            unset($attributes['email']);
        }

        if ($request->hasFile('avatar')) {
            $attributes['avatar'] = $this->avatarUpload($request, $id);
        }

        return $this->firstRepo->update($id, $attributes);
    }

    public function avatarUpload($request, $id)
    {
        $avatarUrl = null;
        if ($request->hasFile('avatar')) {
            $avatarUrl = $request->file('avatar')->storeAs('avatar', md5("avatar-{$id}").'.png');
        }
        return $avatarUrl;
    }

    public function securityFromRequest($request, $id)
    {
        $attributes = $request->only(['password', 'new-password', 'confirm-new-password']);

        if (
            $request->has('new-password')
            && $request->has('confirm-new-password')
            && $this->checkNewPassword($id, $attributes['password'], $attributes['new-password'], $attributes['confirm-new-password'])
        ) {
            $attributes['password'] = Hash::make($attributes['new-password']);
            unset($attributes['new-password']);
            unset($attributes['confirm-new-password']);
        }
        else {
            return false;
        }

        return $this->firstRepo->update($id, $attributes);
    }

    public function checkNewPassword($id, $oldPassword, $newPassword, $confirmPassword = false)
    {
        if (
            strlen($newPassword) > 7
            && (!$confirmPassword || $newPassword == $confirmPassword)
        ) {
            $employee = $this->firstRepo->find($id);
            if (Hash::check($oldPassword, $employee->password)) {
                return true;
            }
        }
        return false;
    }

    public function notifyFromRequest($request, $id)
    {
        $notifyConfig = config('notify.employee');
        $emailEnable = config('notify.email_enable');
        $browserEnable = config('notify.browser_enable');
        $appEnable = config('notify.app_enable');
        $smsEnable = config('notify.sms_enable');
        $attributes = [];
        foreach ($notifyConfig as $key => $value) {
            if ($emailEnable && (!isset($value['type']) || in_array('email', $value['type']))) {
                $attributes["extend_notify_{$key}_email"] = $request->has("extend_notify_{$key}_email");
            }
            if ($browserEnable && (!isset($value['type']) || in_array('browser', $value['type']))) {
                $attributes["extend_notify_{$key}_browser"] = $request->has("extend_notify_{$key}_browser");
            }
            if ($appEnable && (!isset($value['type']) || in_array('app', $value['type']))) {
                $attributes["extend_notify_{$key}_app"] = $request->has("extend_notify_{$key}_app");
            }
            if ($smsEnable && (!isset($value['type']) || in_array('sms', $value['type']))) {
                $attributes["extend_notify_{$key}_sms"] = $request->has("extend_notify_{$key}_sms");
            }
        }

        return $this->firstRepo->updateWithExtend($id, $attributes);
    }

    public function notifySetting($id = false)
    {
        $employee = $id?$this->firstRepo->find($id):Auth::guard('employee')->user();
        $notifyConfig = config('notify.employee');
        $emailEnable = config('notify.email_enable');
        $browserEnable = config('notify.browser_enable');
        $appEnable = config('notify.app_enable');
        $smsEnable = config('notify.sms_enable');
        $notifySetting = [];
        foreach ($notifyConfig as $key => $value) {
            $notifySetting[$key] = [
                'title' => $value['title'],
            ];
            if (isset($value['description'])) {
                $notifySetting[$key]['description'] = $value['description'];
            }
            if ($emailEnable && (!isset($value['type']) || in_array('email', $value['type']))) {
                $notifySetting[$key]['email'] = [
                    'key' => "extend_notify_{$key}_email",
                    'value' => $employee->{"extend_notify_{$key}_email"}??(isset($value['default']) && in_array('email', $value['default']))
                ];
            }
            if ($browserEnable && (!isset($value['type']) || in_array('browser', $value['type']))) {
                $notifySetting[$key]['browser'] = [
                    'key' => "extend_notify_{$key}_browser",
                    'value' => $employee->{"extend_notify_{$key}_browser"}??(isset($value['default']) && in_array('browser', $value['default']))
                ];
            }
            if ($appEnable && (!isset($value['type']) || in_array('app', $value['type']))) {
                $notifySetting[$key]['app'] = [
                    'key' => "extend_notify_{$key}_app",
                    'value' => $employee->{"extend_notify_{$key}_app"}??(isset($value['default']) && in_array('app', $value['default']))
                ];
            }
            if ($smsEnable && (!isset($value['type']) || in_array('sms', $value['type']))) {
                $notifySetting[$key]['sms'] = [
                    'key' => "extend_notify_{$key}_sms",
                    'value' => $employee->{"extend_notify_{$key}_sms"}??(isset($value['default']) && in_array('sms', $value['default']))
                ];
            }
        }
        return $notifySetting;
    }

    public function searchFromRequest($request)
    {
        $attributes = $request->only(['role', 'q']);

        $results = $this->firstRepo->newQuery()
            ->where(function($query) use ($attributes) {
                $query->where('id', $attributes['q']);
                $query->orWhere('phone', 'LIKE', '%' . $attributes['q'] . '%');
                $query->orWhere('email', 'LIKE', '%' . $attributes['q'] . '%');
                $query->orWhere('first_name', 'LIKE', '%' . $attributes['q'] . '%');
                $query->orWhere('last_name', 'LIKE', '%' . $attributes['q'] . '%');
            })
            ->where(function($query) use ($attributes) {
                if (!empty($attributes['role'])) {
                    $query->whereHas('roles', function ($q) use ($attributes) {
                        $q->whereIn('id', (array)$attributes['role']);
                    });
                }
            })
            ->select(['id', 'first_name', 'last_name', 'phone', 'email', 'avatar'])
            ->limit(5)
            ->get()
        ;

        return $results;
    }

}

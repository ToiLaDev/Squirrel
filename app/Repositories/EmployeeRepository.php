<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class EmployeeRepository extends Repository implements EmployeeRepositoryImpl
{

    public function __construct(Employee $employee)
    {
        $this->_model = $employee;
    }

    public function create(array $attributes, $role = false, $permissions = false): Employee
    {
        $attributes['password'] = Hash::make($attributes['password']);

        $employee = parent::create($attributes);

        if ($role !== false) {
            $employee->syncRoles((array)$role);
        }
        if ($permissions !== false) {
            $employee->syncPermissions((array)$permissions);
        }

        return $employee;
    }

    public function update(int $id, array $attributes, $role = false, $permissions = false): Employee
    {
        if (!empty($attributes['password'])) {
            $attributes['password'] = Hash::make($attributes['password']);
        } else {
            unset($attributes['password']);
        }

        $employee = parent::update($id, $attributes);

        if ($role !== false) {
            $employee->syncRoles((array)$role);
        }
        if ($permissions !== false) {
            $employee->syncPermissions((array)$permissions);
        }

        return $employee;
    }

    public function emailExits(string $email, int $id = null): bool
    {
        return $this->_model
                ->where('email', $email)
                ->where('id', '!=', $id)
                ->count('id') > 0;
    }

    public function phoneExits(string $phone, int $id = null): bool
    {
        return $this->_model
                ->where('phone', $phone)
                ->where('id', '!=', $id)
                ->count('id') > 0;
    }

    public function usernameExits(string $username, int $id = null): bool
    {
        return $this->_model
                ->where('username', $username)
                ->where('id', '!=', $id)
                ->count('id') > 0;
    }



}

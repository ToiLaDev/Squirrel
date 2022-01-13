<?php

namespace App\Repositories;


use App\Models\Employee;

interface EmployeeRepositoryImpl
{

    public function create(array $attributes, $role = false, $permissions = false): Employee;
    public function update(int $id, array $attributes, $role = false, $permissions = false): Employee;
    public function emailExits(string $email, int $id = null): bool;
    public function phoneExits(string $phone, int $id = null): bool;
    public function usernameExits(string $username, int $id = null): bool;
}

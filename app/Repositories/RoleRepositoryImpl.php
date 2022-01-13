<?php

namespace App\Repositories;


use Spatie\Permission\Models\Role;

interface RoleRepositoryImpl
{

    public function create(array $attributes, $permissions = false): Role;
    public function update(int $id, array $attributes, $permissions = false): Role;
}

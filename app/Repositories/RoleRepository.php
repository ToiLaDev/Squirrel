<?php

namespace App\Repositories;


use Spatie\Permission\Models\Role;

class RoleRepository extends Repository implements RoleRepositoryImpl
{
    public function __construct(Role $role)
    {
        $this->_model = $role;
    }

    public function create(array $attributes, $permissions = false): Role
    {
        $role = parent::create($attributes);

        if ($permissions !== false) {
            $role->syncPermissions((array)$permissions);
        }

        return $role;
    }

    public function update(int $id, array $attributes, $permissions = false): Role
    {

        $role = parent::update($id, $attributes);

        if ($permissions !== false) {
            $role->syncPermissions((array)$permissions);
        }

        return $role;
    }

}

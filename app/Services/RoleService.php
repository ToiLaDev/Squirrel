<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Illuminate\Http\Request;

class RoleService extends RepositoryService implements RoleServiceImpl
{

    public function __construct(RoleRepository $roleRepo) {
        $this->firstRepo = $roleRepo;
    }

    public function createFromRequest($request)
    {
        $name = $request->input('name');
        $permissions = $request->input('permissions', []);

        return $this->firstRepo->create(['name' => $name], $permissions);
    }

    public function updateFromRequest(int $id, $request)
    {
        $attributes = $request->only(['name']);
        $permissions = $request->input('permissions', []);

        return $this->firstRepo->update($id, $attributes, $permissions);
    }

}

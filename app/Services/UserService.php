<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends RepositoryService implements UserServiceImpl
{

    public function __construct(UserRepository $firstRepo) {
        $this->firstRepo = $firstRepo;
    }
}

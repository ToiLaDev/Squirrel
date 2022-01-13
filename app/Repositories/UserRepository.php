<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{

    public function getModel()
    {
        return User::class;
    }

    public function emailExits(string $email, int $id = null): bool
    {
        return $this->_model
                ->where('email', $email)
                ->whereNot('id', $id)
                ->count() > 0;
    }

    public function phoneExits(string $phone, int $id = null): bool
    {
        return $this->_model
                ->where('phone', $phone)
                ->whereNot('id', $id)
                ->count() > 0;
    }

    public function usernameExits(string $username, int $id = null): bool
    {
        return $this->_model
                ->where('username', $username)
                ->whereNot('id', $id)
                ->count() > 0;
    }

}

<?php

namespace App\Repositories;


interface UserRepositoryImpl
{

    public function search($search, $select = '*', $limit = 10);
    public function findEmail($email);
    public function findUserName($username);
    public function emailExits(string $email, int $id = null): bool;
    public function phoneExits(string $phone, int $id = null): bool;
    public function usernameExits(string $username, int $id = null): bool;
}

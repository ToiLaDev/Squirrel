<?php

namespace App\Repositories;


interface SettingRepositoryImpl
{
    public function set($attributes, $type = 'default');
}

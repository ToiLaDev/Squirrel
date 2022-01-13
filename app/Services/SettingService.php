<?php

namespace App\Services;

use App\Repositories\SettingRepository;

class SettingService extends RepositoryService implements SettingServiceImpl
{

    public function __construct(SettingRepository $settingRepo) {
        $this->firstRepo = $settingRepo;
    }

    public function setFromRequest($request, $type = 'default', $only = false)
    {
        $attributes = $only
            ?$request->only($only)
            :$request->all()
        ;

        $this->firstRepo->set($attributes, $type);
    }

}

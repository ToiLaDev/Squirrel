<?php

namespace App\Repositories;


use App\Models\Setting;

class SettingRepository extends Repository implements SettingRepositoryImpl
{
    public function __construct(Setting $setting)
    {
        $this->_model = $setting;
    }

    public function set($attributes, $type = 'default')
    {
        foreach ($attributes as $key => $val) {
            $setting = $this->_model->firstOrNew(['key' => $key, 'type' => $type]);
            $setting->value = $val;
            $setting->save();
        }
    }

}

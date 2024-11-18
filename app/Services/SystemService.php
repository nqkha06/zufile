<?php

namespace App\Services;

use App\Models\Setting;
use App\Repositories\Interfaces\SettingRepositoryInterface as SettingRepository;

class SystemService
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function get($key, $default = null)
    {
        return $this->settingRepository->getAll($key) ?? $default;
    }

    public function set($key, $value)
    {
        Setting::updateOrInsert(
            ['key' => $key],
            ['value' => $value]
        );
        return true;
    }

    // public function delete($key)
    // {
    //     Setting::where('config_name', $key)->delete();
    //     unset($this->settings[$key]);
    // }

    public function all()
    {   
        $data = $this->settingRepository->getAll();
        $settings = [];
        foreach ($data as $key => $val) {
            $settings[$val->key] = $val->value;
        }
        return $settings;
    }
}

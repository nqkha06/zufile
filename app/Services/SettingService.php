<?php

namespace App\Services;

use App\Models\Setting;
use App\Services\Interfaces\SettingServiceInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface as SettingRepository;

use Illuminate\Support\Facades\Cache;

class SettingService implements SettingServiceInterface
{
    protected $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function get($key, $default = null)
    {
        return Cache::remember("settings.$key", 60 * 60, function() use ($key, $default) {
            return $this->settingRepository->findFirst(['key' => $key])->value ?? $default;
        });
    }

    public function set($key, $value)
    {
        Setting::updateOrInsert(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget("settings.$key");

        Cache::remember("settings.$key", 60 * 60, function() use ($key, $value) {
            return $value;
        });

        return true;
    }

    public function all()
    {   
        return Cache::remember('settings.all', 60 * 60, function() {
            $data = $this->settingRepository->getAll();
            $settings = [];
            foreach ($data as $val) {
                $settings[$val->key] = $val->value;
            }
            return $settings;
        });
    }
}

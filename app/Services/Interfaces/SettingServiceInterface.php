<?php

namespace App\Services\Interfaces;

/**
 * Interface SettingServiceInterface
 * @package App\Services\Interfaces
 */
interface SettingServiceInterface
{
    public function get($key, $default = null);
    public function all();

    public function set($key, $value);

    // public function delete($key);

}

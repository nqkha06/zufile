<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UserSetting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'userSetting';
    }
}

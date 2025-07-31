<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\SettingService as SettingService;

class SettingComposer
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function compose(View $view)
    {
        $settings = $this->settingService->all();
        $view->with('settings', $settings);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        'setting' => 'App\Services\SettingService',
        'language' => 'App\Services\LanguageService',
        'userSetting' => 'App\Services\UserSettingService',
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {

        foreach($this->bindings as $key => $val)
        {
            $this->app->bind($key, $val);
        }

        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Schema::defaultStringLength(191);
        require base_path('routes/breadcrumb.php');

    }
}

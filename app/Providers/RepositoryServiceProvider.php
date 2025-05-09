<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

     public $bindings = [
        'App\Repositories\Interfaces\PaymentMethodRepositoryInterface' => 'App\Repositories\PaymentMethodRepository',

        'App\Repositories\Interfaces\RoleRepositoryInterface' => 'App\Repositories\RoleRepository',
        'App\Repositories\Interfaces\PermissionRepositoryInterface' => 'App\Repositories\PermissionRepository',

        'App\Repositories\Interfaces\WithdrawRepositoryInterface' => 'App\Repositories\WithdrawRepository',
        'App\Repositories\Interfaces\NOTEStatisticRepositoryInterface' => 'App\Repositories\NOTEStatisticRepository',
        'App\Repositories\Interfaces\SettingRepositoryInterface' => 'App\Repositories\SettingRepository',
        'App\Repositories\Interfaces\LevelRepositoryInterface' => 'App\Repositories\LevelRepository',
        'App\Repositories\Interfaces\NOTELevelRepositoryInterface' => 'App\Repositories\NOTELevelRepository',
        'App\Repositories\Interfaces\STURepositoryInterface' => 'App\Repositories\STURepository',
        'App\Repositories\Interfaces\NOTERepositoryInterface' => 'App\Repositories\NOTERepository',

        'App\Repositories\Interfaces\CategoryRepositoryInterface' => 'App\Repositories\CategoryRepository',
        'App\Repositories\Interfaces\TagRepositoryInterface' => 'App\Repositories\TagRepository',
        'App\Repositories\Interfaces\PageRepositoryInterface' => 'App\Repositories\PageRepository',
        'App\Repositories\Interfaces\PostRepositoryInterface' => 'App\Repositories\PostRepository',
        'App\Repositories\Interfaces\PostViewRepositoryInterface' => 'App\Repositories\PostViewRepository',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',
        'App\Repositories\Interfaces\AccessRepositoryInterface' => 'App\Repositories\AccessRepository',
        'App\Repositories\Interfaces\STUAccessRepositoryInterface' => 'App\Repositories\STUAccessRepository',
        'App\Repositories\Interfaces\AddressRepositoryInterface' => 'App\Repositories\AddressRepository',
        'App\Repositories\Interfaces\STULogReferralRepositoryInterface' => 'App\Repositories\STULogReferralRepository',
        'App\Repositories\Interfaces\STUStatisticRepositoryInterface' => 'App\Repositories\STUStatisticRepository',

        'App\Repositories\Interfaces\WidgetRepositoryInterface' => 'App\Repositories\WidgetRepository',

    ];

    public function register(): void
    {
        foreach($this->bindings as $key => $val)
        {
            $this->app->bind($key, $val);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

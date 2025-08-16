<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.blog2', 'App\Http\ViewComposers\CategoriesComposer');
        View::composer('layouts.blog2', 'App\Http\ViewComposers\PopularPostsComposer');
        View::composer(['layouts.*', 'frontend.*'], 'App\Http\ViewComposers\MenusComposer');
        View::composer(
            ['backend.member.*', 'backend.member_2.*','backend.admin.*'],
            'App\Http\ViewComposers\SettingComposer'
        );
        // View::composer(
        //     ['backend.member.*', 'backend.member_2.*', 'backend.admin.*', 'clients.*'],
        //     'App\Http\ViewComposers\STULevelComposer'
        // );
        // View::composer(
        //     ['backend.member.*', 'backend.member_2.*', 'backend.admin.*', 'clients.*'],
        //     'App\Http\ViewComposers\NOTELevelComposer'
        // );
        View::composer(
            ['backend.member.*', 'backend.member_2.*', 'backend.admin.*', 'layouts.blog2'],
            'App\Http\ViewComposers\BaseStatusComposer'
        );
    }
}

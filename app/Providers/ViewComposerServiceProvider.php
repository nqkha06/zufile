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
        View::composer('layouts.*', 'App\Http\ViewComposers\MenusComposer');
        View::composer(
            ['backend.member.*','backend.admin.*'], 
            'App\Http\ViewComposers\SettingComposer'
        );
        View::composer(
            ['backend.member.*', 'backend.admin.*', 'clients.*'], 
            'App\Http\ViewComposers\STULevelComposer'
        );
        View::composer(
            ['backend.member.*', 'backend.admin.*', 'clients.*'], 
            'App\Http\ViewComposers\NOTELevelComposer'
        );
    }
}

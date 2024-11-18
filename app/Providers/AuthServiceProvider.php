<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword as LaravelResetPassword;
use App\Notifications\CustomResetPassword;
use App\Models\StuLink;
use App\Models\Post;
use App\Policies\STUPolicy;
use App\Policies\PostPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        StuLink::class => STUPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Sử dụng thông báo đã được xếp hàng
        LaravelResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new CustomResetPassword($token))->toMail($notifiable);
        });
    }
}

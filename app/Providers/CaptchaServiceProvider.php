<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Captcha\CaptchaServiceInterface;
use App\Services\Captcha\RecaptchaService;
use App\Services\Captcha\HcaptchaService;

class CaptchaServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CaptchaServiceInterface::class, function () {
            $driver = config('captcha.driver');

            return match ($driver) {
                'recaptcha' => new RecaptchaService(),
                'hcaptcha'  => new HcaptchaService(),
                default     => throw new \Exception("Unsupported captcha driver: $driver"),
            };
        });
    }
}

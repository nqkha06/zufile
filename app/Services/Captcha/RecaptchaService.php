<?php
namespace App\Services\Captcha;

use Illuminate\Support\Facades\Http;

class RecaptchaService implements CaptchaServiceInterface
{
    public function render(): string
    {
        $siteKey = config('captcha.recaptcha.site_key');
        return '<div class="g-recaptcha" data-sitekey="' . $siteKey . '"></div>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>';
    }

    public function validate(string $token): bool
    {
        $secret = config('captcha.recaptcha.secret_key');
        $response = Http::asForm()->post(config('captcha.recaptcha.verify_url'), [
            'secret' => $secret,
            'response' => $token,
        ]);

        return $response->json()['success'] ?? false;
    }
}

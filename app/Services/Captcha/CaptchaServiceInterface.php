<?php
namespace App\Services\Captcha;

interface CaptchaServiceInterface
{
    public function render(): string;

    public function validate(string $token): bool;
}

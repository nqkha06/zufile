<?php
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Services\Captcha\CaptchaServiceInterface;

class CaptchaRule implements ValidationRule
{
    protected CaptchaServiceInterface $captcha;

    public function __construct(CaptchaServiceInterface $captcha)
    {
        $this->captcha = $captcha;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->captcha->validate($value)) {
            $fail('Captcha validation failed.');
        }
    }
}


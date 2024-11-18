<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as LaravelResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomResetPassword extends LaravelResetPassword implements ShouldQueue
{
    use Queueable;
}

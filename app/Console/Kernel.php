<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // Disable expired plans daily at 00:10
        $schedule->command('plans:disable-expired')->dailyAt('00:10');

        // Send expiration notifications daily at 09:00 (7 days before expiration)
        $schedule->command('plans:send-expiration-notifications --days=7')->dailyAt('09:00');

        // Send urgent expiration notifications daily at 09:30 (1 day before expiration)
        $schedule->command('plans:send-expiration-notifications --days=1')->dailyAt('09:30');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

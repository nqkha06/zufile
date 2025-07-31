<?php

namespace App\Console\Commands;

use App\Services\PlanService;
use Illuminate\Console\Command;

class ProcessExpiredPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plans:process-expired {--dry-run : Display what would be processed without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Track and report expired plans (does not auto-downgrade)';

    protected PlanService $planService;

    public function __construct(PlanService $planService)
    {
        parent::__construct();
        $this->planService = $planService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Tracking expired plans...');

        if ($this->option('dry-run')) {
            $expiredUsers = $this->planService->getUsersWithExpiredPlans();

            if ($expiredUsers->isEmpty()) {
                $this->info('No expired plans found.');
                return 0;
            }

            $this->info("Found {$expiredUsers->count()} users with expired plans:");

            $this->table(
                ['User ID', 'User Name', 'Email', 'Plan', 'Expired At'],
                $expiredUsers->map(function ($user) {
                    return [
                        $user->id,
                        $user->name,
                        $user->email,
                        $user->plan->name,
                        $user->plan_expires_at->format('Y-m-d H:i:s'),
                    ];
                })->toArray()
            );

            $this->warn('This was a dry run. These plans are expired but users will keep their plans with free plan limitations.');
            return 0;
        }

        $count = $this->planService->processExpiredPlans();

        if ($count > 0) {
            $this->info("Successfully tracked {$count} expired plans.");
        } else {
            $this->info('No expired plans found to track.');
        }

        return 0;
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\PlanUser;

class DisableExpiredPlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plans:disable-expired {--dry-run : Preview what would be disabled without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable expired plans for users and notify them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Checking for expired plans...');

        $expiredPlans = PlanUser::where('is_active', true)
            ->where('expires_at', '<', now())
            ->with(['user', 'plan'])
            ->get();

        if ($expiredPlans->isEmpty()) {
            $this->info('✅ No expired plans found.');
            return 0;
        }

        $this->table(
            ['User', 'Plan', 'Expired At', 'Days Overdue'],
            $expiredPlans->map(function ($planUser) {
                return [
                    $planUser->user->name . ' (' . $planUser->user->email . ')',
                    $planUser->plan->name,
                    $planUser->expires_at->format('Y-m-d H:i:s'),
                    $planUser->expires_at->diffInDays(now()) . ' days'
                ];
            })
        );

        if ($this->option('dry-run')) {
            $this->warn('🔍 DRY RUN: No changes made. Use without --dry-run to disable expired plans.');
            return 0;
        }

        if (!$this->confirm('Do you want to disable these ' . $expiredPlans->count() . ' expired plans?')) {
            $this->info('❌ Operation cancelled.');
            return 0;
        }

        $count = 0;
        $this->withProgressBar($expiredPlans, function ($planUser) use (&$count) {
            $planUser->update(['is_active' => false]);

            // Log the expiration
            Log::info('Plan expired and disabled', [
                'user_id' => $planUser->user_id,
                'plan_id' => $planUser->plan_id,
                'plan_name' => $planUser->plan->name,
                'expired_at' => $planUser->expires_at,
                'disabled_at' => now()
            ]);

            $count++;
        });

        $this->newLine(2);
        $this->info("✅ Successfully disabled $count expired plans.");
        $this->info('📧 Users will see renewal prompts on their next login.');

        return 0;
    }
}

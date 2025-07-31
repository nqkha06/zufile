<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PlanService;
use App\Models\User;
use App\Models\PlanUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendPlanExpirationNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plans:send-expiration-notifications {--days=7 : Days before expiration to send notification}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications to users with expiring plans';

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
        $days = (int) $this->option('days');

        $this->info("🔍 Checking for plans expiring in {$days} days...");

        // Get users with expiring plans
        $usersWithExpiringPlans = $this->planService->getUsersWithExpiringPlans($days);

        if ($usersWithExpiringPlans->isEmpty()) {
            $this->info('✅ No users with expiring plans found.');
            return 0;
        }

        $this->info("📧 Found {$usersWithExpiringPlans->count()} users with expiring plans.");

        $sentCount = 0;
        $errorCount = 0;

        $this->withProgressBar($usersWithExpiringPlans, function ($user) use (&$sentCount, &$errorCount) {
            try {
                $this->sendExpirationNotification($user);
                $sentCount++;

                Log::info('Plan expiration notification sent', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'plan_name' => $user->currentPlan->plan->name,
                    'expires_at' => $user->currentPlan->expires_at
                ]);

            } catch (\Exception $e) {
                $errorCount++;

                Log::error('Failed to send plan expiration notification', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'error' => $e->getMessage()
                ]);

                $this->error("Failed to send notification to {$user->email}: " . $e->getMessage());
            }
        });

        $this->newLine(2);
        $this->info("✅ Successfully sent {$sentCount} notifications.");

        if ($errorCount > 0) {
            $this->warn("⚠️  {$errorCount} notifications failed to send.");
        }

        return 0;
    }

    /**
     * Send expiration notification to user
     */
    private function sendExpirationNotification(User $user): void
    {
        $currentPlan = $user->currentPlan;
        $daysUntilExpiration = $currentPlan->getDaysUntilExpiration();

        // For now, we'll just log the notification
        // In a real application, you would send an actual email
        $this->sendNotificationEmail($user, $currentPlan, $daysUntilExpiration);
    }

    /**
     * Send the actual notification email
     */
    private function sendNotificationEmail(User $user, PlanUser $planUser, int $daysLeft): void
    {
        // Example email sending - you would implement actual email template
        $emailData = [
            'user_name' => $user->name,
            'plan_name' => $planUser->plan->name,
            'expires_at' => $planUser->expires_at->format('M d, Y H:i'),
            'days_left' => $daysLeft,
            'renewal_url' => route('plans.index'),
        ];

        // Uncomment and implement when you have email templates ready
        /*
        Mail::send('emails.plan-expiration-notification', $emailData, function ($message) use ($user) {
            $message->to($user->email, $user->name)
                    ->subject('Your Plan is Expiring Soon');
        });
        */

        // For now, just log the email data
        Log::info('Plan expiration email would be sent', $emailData);
    }
}

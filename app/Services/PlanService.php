<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlanService
{
    /**
     * Assign a plan to a user
     */
    public function assignPlanToUser(User $user, Plan $plan, int $durationInDays = 30, float $pricePaid = 0): bool
    {
        return DB::transaction(function () use ($user, $plan, $durationInDays, $pricePaid) {
            $oldPlan = $user->plan;

            $user->assignPlan($plan->id, $durationInDays);

            Log::info('Plan assigned to user', [
                'user_id' => $user->id,
                'old_plan_id' => $oldPlan?->id,
                'old_plan_name' => $oldPlan?->name,
                'new_plan_id' => $plan->id,
                'new_plan_name' => $plan->name,
                'duration_days' => $durationInDays,
                'expires_at' => $user->plan_expires_at,
                'price_paid' => $pricePaid
            ]);

            return true;
        });
    }

    /**
     * Upgrade user to a new plan
     */
    public function upgradePlan(User $user, Plan $newPlan, int $durationInDays = 30, float $pricePaid = 0): bool
    {
        $currentPlan = $user->plan;

        if ($currentPlan) {
            Log::info('Plan upgrade initiated', [
                'user_id' => $user->id,
                'from_plan_id' => $currentPlan->id,
                'from_plan_name' => $currentPlan->name,
                'to_plan_id' => $newPlan->id,
                'to_plan_name' => $newPlan->name,
                'current_expires_at' => $user->plan_expires_at
            ]);
        }

        return $this->assignPlanToUser($user, $newPlan, $durationInDays, $pricePaid);
    }

    /**
     * Renew current plan
     */
    public function renewPlan(User $user, int $durationInDays = 30, float $pricePaid = 0): bool
    {
        if (!$user->plan_id || $user->plan_id === 1) {
            throw new \Exception('No active plan to renew');
        }

        return DB::transaction(function () use ($user, $durationInDays, $pricePaid) {
            $oldExpiresAt = $user->plan_expires_at;

            $user->renewPlan($durationInDays);

            Log::info('Plan renewed', [
                'user_id' => $user->id,
                'plan_id' => $user->plan_id,
                'plan_name' => $user->plan->name,
                'old_expires_at' => $oldExpiresAt,
                'new_expires_at' => $user->plan_expires_at,
                'duration_days' => $durationInDays,
                'price_paid' => $pricePaid
            ]);

            return true;
        });
    }

    /**
     * Downgrade to free plan
     */
    public function downgradeToFreePlan(User $user, $planId): bool
    {
        $planTarget = Plan::find($planId);
        if (!$planTarget) {
            throw new \Exception('Invalid plan for downgrade');
        }
        $freePlan = Plan::where('price', 0)->first();

        if (!$freePlan) {
            throw new \Exception('Free plan not found');
        }
        $user->plan_id = $planId;
        $user->save();
        return true;
        return DB::transaction(function () use ($user, $freePlan) {
            $oldPlan = $user->plan;

            $user->downgradeToFreePlan();

            Log::info('User downgraded to free plan', [
                'user_id' => $user->id,
                'old_plan_id' => $oldPlan?->id,
                'old_plan_name' => $oldPlan?->name,
                'old_expires_at' => $user->plan_expires_at,
                'downgraded_at' => now()
            ]);

            return true;
        });
    }

    /**
     * Get users with expiring plans
     */
    public function getUsersWithExpiringPlans(int $days = 7): \Illuminate\Database\Eloquent\Collection
    {
        return User::with('plan')
            ->where('plan_id', '!=', 1) // Not free plan
            ->whereNotNull('plan_expires_at')
            ->where('plan_expires_at', '>', now())
            ->where('plan_expires_at', '<=', now()->addDays($days))
            ->get();
    }

    /**
     * Get users with expired plans
     */
    public function getUsersWithExpiredPlans(): \Illuminate\Database\Eloquent\Collection
    {
        return User::with('plan')
            ->where('plan_id', '!=', 1) // Not free plan
            ->whereNotNull('plan_expires_at')
            ->where('plan_expires_at', '<', now())
            ->get();
    }

    /**
     * Process expired plans (just log/track, don't auto-downgrade)
     */
    public function processExpiredPlans(): int
    {
        $expiredUsers = $this->getUsersWithExpiredPlans();
        $count = 0;

        foreach ($expiredUsers as $user) {
            // Just track expired plans, don't auto-downgrade
            $user->handleExpiredPlan();

            Log::info('Processed expired plan', [
                'user_id' => $user->id,
                'plan_id' => $user->plan_id,
                'plan_name' => $user->plan->name,
                'expired_at' => $user->plan_expires_at,
                'processed_at' => now()
            ]);

            $count++;
        }

        return $count;
    }

    /**
     * Get plan statistics
     */
    public function getPlanStatistics(): array
    {
        $totalUsers = User::count();
        $activeSubscriptions = User::where('plan_id', '!=', 1)
            ->where(function ($query) {
                $query->whereNull('plan_expires_at')
                      ->orWhere('plan_expires_at', '>', now());
            })
            ->count();

        $expiredSubscriptions = User::where('plan_id', '!=', 1)
            ->whereNotNull('plan_expires_at')
            ->where('plan_expires_at', '<', now())
            ->count();

        $expiringSoon = User::where('plan_id', '!=', 1)
            ->whereNotNull('plan_expires_at')
            ->where('plan_expires_at', '>', now())
            ->where('plan_expires_at', '<=', now()->addDays(7))
            ->count();

        $planDistribution = Plan::withCount(['users' => function ($query) {
            $query->where(function ($q) {
                $q->whereNull('plan_expires_at')
                  ->orWhere('plan_expires_at', '>', now());
            });
        }])->get()->pluck('users_count', 'name')->toArray();

        return [
            'total_users' => $totalUsers,
            'active_subscriptions' => $activeSubscriptions,
            'expired_subscriptions' => $expiredSubscriptions,
            'expiring_soon' => $expiringSoon,
            'free_plan_users' => $totalUsers - $activeSubscriptions - $expiredSubscriptions,
            'plans_by_type' => $planDistribution,
        ];
    }

    /**
     * Check if user can upgrade/downgrade to a specific plan
     */
    public function canChangePlan(User $user, Plan $targetPlan): array
    {
        $currentPlan = $user->plan;

        if (!$currentPlan) {
            return ['can_change' => true, 'message' => 'No current plan'];
        }

        // Same plan
        if ($currentPlan->id === $targetPlan->id) {
            return ['can_change' => false, 'message' => 'Already on this plan'];
        }

        // Check if it's an upgrade or downgrade
        $isUpgrade = $targetPlan->price > $currentPlan->price;
        $isDowngrade = $targetPlan->price < $currentPlan->price;

        if ($isDowngrade && $user->used_storage > $targetPlan->storage_limit) {
            return [
                'can_change' => false,
                'message' => 'Cannot downgrade: Current storage usage exceeds target plan limit'
            ];
        }

        return [
            'can_change' => true,
            'message' => $isUpgrade ? 'Upgrade available' : 'Downgrade available',
            'type' => $isUpgrade ? 'upgrade' : 'downgrade'
        ];
    }
}

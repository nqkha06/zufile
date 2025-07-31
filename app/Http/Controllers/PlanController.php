<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Services\PlanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    protected PlanService $planService;

    public function __construct(PlanService $planService)
    {
        $this->planService = $planService;
    }

    /**
     * Display available plans
     */
    public function index()
    {
        $plans = Plan::orderBy('price')->get();
        $user = Auth::user();

        // Make sure expired plans are handled
        $user->handleExpiredPlan();

        $currentPlan = $user->plan;

        return view('plans.index', compact('plans', 'user', 'currentPlan'));
    }

    /**
     * Show plan details
     */
    public function show(Plan $plan)
    {
        $user = Auth::user();
        $canChange = $this->planService->canChangePlan($user, $plan);

        return view('plans.show', compact('plan', 'user', 'canChange'));
    }

    /**
     * Upgrade to a new plan
     */
    public function upgrade(Request $request, Plan $plan)
    {
        $request->validate([
            'duration' => 'required|integer|min:1|max:365',
            'method' => 'required|string|in:balance,paypal',
        ]);

        $user = Auth::user();
        $canChange = $this->planService->canChangePlan($user, $plan);

        if (!$canChange['can_change']) {
            if ($request->expectsJson()) {
                return response()->json(['error' => $canChange['message']], 422);
            }
            return back()->with('error', $canChange['message']);
        }

        try {
            $duration = $request->input('duration', 30);
            $method = $request->input('method');
            $pricePaid = $plan->price * ($duration / 30); // Calculate based on monthly price

            // Handle different payment methods
            if ($method === 'balance') {
                if ($user->balance < $pricePaid) {
                    $message = 'Insufficient balance. Required: $' . number_format($pricePaid, 2);
                    if ($request->expectsJson()) {
                        return response()->json(['error' => $message], 422);
                    }
                    return back()->with('error', $message);
                }

                // Deduct from balance
                $user->balance -= $pricePaid;
                $user->save();
            } elseif ($method === 'paypal') {
                // For PayPal, we would redirect to PayPal - for now just simulate success
                // In real implementation, you'd integrate with PayPal API
                if ($request->expectsJson()) {
                    return response()->json([
                        'url' => 'https://paypal.com/checkout/example', // PayPal checkout URL
                    ]);
                }
            }

            $success = $this->planService->upgradePlan($user, $plan, $duration, $pricePaid);

            if ($success) {
                $message = "Successfully upgraded to {$plan->name} for {$duration} days!";

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true,
                        'message' => $message,
                        'reload' => true
                    ]);
                }

                return redirect()->route('plans.index')->with('success', $message);
            } else {
                $message = 'Failed to upgrade plan';
                if ($request->expectsJson()) {
                    return response()->json(['error' => $message], 500);
                }
                return back()->with('error', $message);
            }

        } catch (\Exception $e) {
            $message = 'Failed to upgrade plan: ' . $e->getMessage();
            if ($request->expectsJson()) {
                return response()->json(['error' => $message], 500);
            }
            return back()->with('error', $message);
        }
    }

    /**
     * Renew current plan
     */
    public function renew(Request $request)
    {
        $request->validate([
            'duration' => 'required|integer|min:1|max:365',
        ]);

        $user = Auth::user();

        if (!$user->plan_id || $user->plan_id === 1) {
            return back()->with('error', 'No active plan to renew');
        }

        try {
            $duration = $request->input('duration', 30);
            $plan = $user->plan;
            $pricePaid = $plan->price * ($duration / 30);

            $success = $this->planService->renewPlan($user, $duration, $pricePaid);

            if ($success) {
                return back()->with('success',
                    "Successfully renewed {$plan->name} for {$duration} days!");
            } else {
                return back()->with('error', 'Failed to renew plan');
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to renew plan: ' . $e->getMessage());
        }
    }

    /**
     * Downgrade to free plan
     */
    public function downgrade()
    {
        $user = Auth::user();

        try {
            $success = $this->planService->downgradeToFreePlan($user);

            if ($success) {
                return redirect()->route('plans.index')->with('success',
                    'Successfully downgraded to free plan');
            } else {
                return back()->with('error', 'Failed to downgrade');
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to downgrade: ' . $e->getMessage());
        }
    }

    /**
     * Get current plan status (AJAX)
     */
    public function status()
    {
        $user = Auth::user();

        // Handle expired plans
        $user->handleExpiredPlan();

        $currentPlan = $user->plan;

        if (!$currentPlan || $user->isOnFreePlan()) {
            return response()->json([
                'status' => 'free_plan',
                'message' => 'On free plan'
            ]);
        }

        $isActive = !$user->hasPlanExpired();

        return response()->json([
            'status' => $isActive ? 'active' : 'expired',
            'plan_name' => $currentPlan->name,
            'expires_at' => $user->plan_expires_at?->format('Y-m-d H:i:s'),
            'days_until_expiration' => $user->getDaysUntilExpiration(),
            'is_expiring_soon' => $user->isPlanExpiringSoon(),
            'storage_usage' => [
                'used' => $user->used_storage,
                'limit' => $currentPlan->storage_limit,
                'percentage' => $user->getStorageUsagePercentage(),
                'formatted_used' => $user->used_storage_formatted,
                'formatted_limit' => $currentPlan->formatted_storage_limit
            ]
        ]);
    }

    /**
     * Dashboard view with plan information
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Handle expired plans
        $user->handleExpiredPlan();

        $currentPlan = $user->plan;
        $availablePlans = Plan::where('id', '!=', $user->plan_id)->orderBy('price')->get();

        $data = [
            'user' => $user,
            'currentPlan' => $currentPlan,
            'availablePlans' => $availablePlans,
            'storageUsage' => $user->getStorageUsagePercentage(),
            'planStatus' => $user->getPlanStatus(),
            'canUpload' => $user->hasActivePlan(),
        ];

        return view('dashboard.plan', $data);
    }
}

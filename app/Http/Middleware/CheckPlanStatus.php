<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPlanStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$features): Response
    {
        $user = $request->user();

        if (!$user) {
            return $next($request);
        }

        // Check if user has an active plan
        if (!$user->hasActivePlan()) {
            // If accessing upload functionality, redirect to plans
            if (in_array('upload', $features)) {
                return redirect()->route('plans.index')
                    ->with('error', 'You need an active plan to upload files.');
            }

            // If accessing premium features, show warning
            if (in_array('premium', $features)) {
                return redirect()->back()
                    ->with('warning', 'This feature requires an active subscription plan.');
            }
        }

        // Check if plan is expired
        if ($user->hasPlanExpired()) {
            // Add warning to session for display
            session()->flash('plan_expired_warning',
                'Your plan has expired. Please renew to continue using premium features.');

            // If accessing upload functionality with expired plan, redirect
            if (in_array('upload', $features)) {
                return redirect()->route('plans.index')
                    ->with('error', 'Your plan has expired. Please renew to continue uploading files.');
            }
        }

        // Check if plan is expiring soon
        if ($user->isPlanExpiringSoon(3)) {
            $daysLeft = $user->currentPlan->getDaysUntilExpiration();
            session()->flash('plan_expiring_warning',
                "Your plan expires in {$daysLeft} day" . ($daysLeft > 1 ? 's' : '') . ". Consider renewing soon.");
        }

        // Check storage limits for file uploads
        if (in_array('check_storage', $features) && $request->hasFile('file')) {
            $file = $request->file('file');
            if (!$user->canUploadFile($file->getSize())) {
                return redirect()->back()
                    ->with('error', 'File upload failed: Either file size exceeds limit or storage quota exceeded.');
            }
        }

        return $next($request);
    }
}

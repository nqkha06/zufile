<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleExpiredPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->hasPlanExpired()) {
            // Just track the expired plan, don't auto-downgrade
            $user->handleExpiredPlan();

            // Add a flash message to inform the user about expiration
            if (!$request->ajax() && !$request->wantsJson()) {
                session()->flash('warning', 'Your plan has expired. You are now using free plan features. Please renew your plan or upgrade to continue using premium features.');
            }
        }

        return $next($request);
    }
}

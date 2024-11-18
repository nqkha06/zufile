<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectToNonWww
{
    public function handle(Request $request, Closure $next)
    {
        if (strpos($request->getHost(), 'www.') === 0) {
            return redirect()->to($request->getScheme().'://'.substr($request->getHost(), 4).$request->getRequestUri(), 302);
        }

        return $next($request);
    }
}

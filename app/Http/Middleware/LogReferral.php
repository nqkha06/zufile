<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\STULogReferralRepositoryInterface as STULogReferralRepository;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
use Illuminate\Support\Facades\DB;

class LogReferral
{
    protected $STULogReferralRepository;

    protected $STURepository;

    public function __construct(STULogReferralRepository $STULogReferralRepository, STURepository $STURepository)
    {
        $this->STULogReferralRepository = $STULogReferralRepository;
        $this->STURepository = $STURepository;
    }

    public function handle(Request $request, Closure $next)
    {
        $referrer = $request->headers->get('referer', 'direct');
        $alias = $request->path();

        $ip_address = generate_random_ip("1.150.113.16");
        $ip_address = $request->ip();

        $link_data = $this->STURepository->firstByCondition([[DB::raw('BINARY alias'), '=', $alias], ['status', '=', 1]]);
        if ($link_data) {
            $identifier = generateUniqueIdentifier($request);

            $data = $this->STULogReferralRepository->updateOrInsert([
                'link_id' => $link_data->id,
                'ip_address' => $ip_address,
                
            ], [
                'identifier' => $identifier,
                'referrer_url' => $referrer,
                'visited_at' => now()
            ]);

            return $next($request);
        }

        return abort(404);
    }
}
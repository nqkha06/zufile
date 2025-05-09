<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface as userRepository;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as withdrawRepository;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Cache;
use App\Enums\InvoiceStatusEnum;

class UserMetric
{
    protected $userRepository;
    protected $withdrawRepository;

    public function __construct (
        UserRepository $userRepository,
        WithdrawRepository $withdrawRepository
    ) {
        $this->userRepository = $userRepository;
        $this->withdrawRepository = $withdrawRepository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = Auth::user();
        
        // if ($user) {
        //     // Tạo cache key duy nhất cho từng người dùng
        //     $cacheKey = 'user_metric_' . $user->id;
            
        //     // Thời gian lưu cache (phút)
        //     $cacheTime = 60; // Cache trong 60 phút

        //     // $totalAmounts = [
        //     //     'pending' => $user->withdraw->where('status', InvoiceStatusEnum::PENDING)->sum('amount'),
        //     //     'approved' => $user->withdraw->where('status', InvoiceStatusEnum::REVIEWED)->sum('amount'),
        //     //     'completed' => $user->withdraw->where('status', InvoiceStatusEnum::COMPLETED)->sum('amount'),
        //     //     'cancelled' => $user->withdraw->where('status', InvoiceStatusEnum::FAILED)->sum('amount'),
        //     //     'hold' => $user->withdraw->where('status', InvoiceStatusEnum::ON_HOLD)->sum('amount'),
        //     // ];
        //     // $totalRevenue = $user->STUstats->sum('revenue') + $user->NOTEStats->sum('revenue');
        //     // $totalViews = $user->STUstats->sum('clicks') + $user->NOTEStats->sum('clicks');
        //     // $totalBalance = $totalRevenue - $totalAmounts['pending'] - $totalAmounts['approved'] - $totalAmounts['completed'] - $totalAmounts['hold'];
            
        //     // // Lấy dữ liệu từ cache hoặc tính toán nếu chưa có trong cache
        //     // $metric = [
        //     //     'total_pending' => $totalAmounts['pending'],
        //     //     'total_approved' => $totalAmounts['approved'],
        //     //     'total_completed' => $totalAmounts['completed'],
        //     //     'total_cancelled' => $totalAmounts['cancelled'],
        //     //     'total_hold' => $totalAmounts['hold'],
        //     //     'total_revenue' => $totalRevenue,
        //     //     'total_views' => $totalViews,
        //     //     'total_balance' => $totalBalance + $user->balance,
        //     // ];
        //     $metric = Cache::remember($cacheKey, $cacheTime, function () use ($user) {
        //         $totalAmounts = [
        //             'pending' => $user->withdraw->where('status', 'pending')->sum('amount'),
        //             'approved' => $user->withdraw->where('status', 'approved')->sum('amount'),
        //             'completed' => $user->withdraw->where('status', 'completed')->sum('amount'),
        //             'cancelled' => $user->withdraw->where('status', 'cancelled')->sum('amount'),
        //             'hold' => $user->withdraw->where('status', 'hold')->sum('amount'),
        //         ];
                
        //         $totalRevenue = $user->STUstats->sum('revenue') + $user->NOTEStats->sum('revenue');
        //         $totalViews = $user->STUstats->sum('clicks') + $user->NOTEStats->sum('clicks');
        //         $totalBalance = $totalRevenue - $totalAmounts['pending'] - $totalAmounts['approved'] - $totalAmounts['completed'] - $totalAmounts['hold'];
                
        //         return [
        //             'total_pending' => $totalAmounts['pending'],
        //             'total_approved' => $totalAmounts['approved'],
        //             'total_completed' => $totalAmounts['completed'],
        //             'total_cancelled' => $totalAmounts['cancelled'],
        //             'total_hold' => $totalAmounts['hold'],
        //             'total_revenue' => $totalRevenue,
        //             'total_views' => $totalViews,
        //             'total_balance' => $totalBalance,
        //         ];
                
        //     });

        //     // Đính kèm dữ liệu metric vào request
        //     $request->attributes->set('user_metric', $metric);
        // }

        return $next($request);
    }
}

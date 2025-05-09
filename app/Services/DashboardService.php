<?php

namespace App\Services;

use App\Services\Interfaces\DashboardServiceInterface;
use App\Repositories\Interfaces\NOTEStatisticRepositoryInterface as STUStatisticRepository;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
use App\Repositories\Interfaces\NOTERepositoryInterface as NOTERepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use function PHPSTORM_META\type;

/**
 * Class DashboardService
 * @package App\Services
 */
class DashboardService
{
    protected $STUStatisticRepository;
    protected $withdrawRepository;
    protected $userRepository;
    protected $STURepository;
    protected $NOTERepository;

    public function __construct(
        STUStatisticRepository $STUStatisticRepository,
        WithdrawRepository $withdrawRepository,
        UserRepository $userRepository,
        STURepository $STURepository,
        NOTERepository $NOTERepository)
    {
        $this->STUStatisticRepository = $STUStatisticRepository;
        $this->withdrawRepository = $withdrawRepository;
        $this->userRepository = $userRepository;
        $this->STURepository = $STURepository;
        $this->NOTERepository = $NOTERepository;
    }
    
    public function generate($request)
    {
        $user = $request->user();
        
        $allDates = [];
        [$startDate, $endDate] = handle_date_range($request->startDate, $request->endDate);
        $currentDate = $startDate;

        while (strtotime($currentDate) <= strtotime($endDate)) {
            $allDates[] = date('Y-m-d', strtotime($currentDate));
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        $report = $user->STUstatics()
        ->whereBetween('created_at', [$startDate, $endDate])
        ->selectRaw('DATE(created_at) as date, COUNT(*) as views, SUM(revenue) as revenue')
        ->groupBy('date')
        ->get();

        $NOTE_report = $user->NOTEStats
            ->where('date', '>=', $startDate)
            ->where('date', '<=', $endDate)
            ->groupBy('date');
        $referral_stats = $user->commissions()
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->selectRaw('DATE(created_at) as date, SUM(amount) as amount')
            ->groupBy('date')
            ->get();

        $total_clicks = 0;
        $total_revenue = 0;
        $total_referral = 0;
        $_report = [];

        foreach ($allDates as $date) {
            if ($report->where('date', '=', $date)->first()) {
                $stu_clicks = $report->where('date', '=', $date)->sum('views');
                $stu_revenue = $report->where('date', '=', $date)->sum('revenue');
            } else {
                $stu_clicks = 0;
                $stu_revenue = 0;
            }
            
            if ($referral_stats->where('date', '=', $date)->first()) {
                $referral = $referral_stats->where('date', '=', $date)->sum('amount');
            } else {
                $referral = 0;
            }

            $note_clicks = isset($NOTE_report[$date]) ? $NOTE_report[$date]->sum('clicks') : 0;
            $note_revenue = isset($NOTE_report[$date]) ? $NOTE_report[$date]->sum('revenue') : 0;
        
            $clicks = $stu_clicks + $note_clicks;
            $revenue = $stu_revenue + $note_revenue;

            $cpm = $clicks > 0 ? ($revenue / $clicks) * 1000 : 0;
        
            $_report[$date] = [
                'date' => $date,
                'clicks' => $clicks,
                'revenue' => $revenue,
                'referral' => $referral,
                'cpm' => $cpm,
            ];
        
            $total_clicks += $clicks;
            $total_revenue += $revenue;
            $total_referral += $referral;
        }

        $_report = collect($_report);

        $perPage = 10;
        $currentPage = request()->get('page', 1);

        $paginatedReport = new LengthAwarePaginator(
            $_report->forPage($currentPage, $perPage),
            $_report->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $cpm = $total_clicks > 0 ? (($total_revenue / $total_clicks) * 1000) : 0;

        $total_revenue = round($total_revenue, 3);
        $total_referral = round($total_referral, 3);
        $cpm = round($cpm, 3);

        return [
            'report' => $_report,
            'paginatedReport' => $paginatedReport,
            'total_clicks' => $total_clicks,
            'total_revenue' => $total_revenue,
            'total_referral' => $total_referral,
            'cpm' => $cpm,
        ];
    }
}

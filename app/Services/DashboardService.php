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

/**
 * Class DashboardService
 * @package App\Services
 */
class DashboardService implements DashboardServiceInterface
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
    
    public function generate($request, $month, $year)
    {
        $user = $request->user();
        $monthPar = $month;
        $yearPar = $year;
    
        $join_at = strtotime($user->created_at);
        $currTime = time();
        $currentMonth = date('m');
        $currentYear = date('Y');
    
        if ($monthPar == $currentMonth && $yearPar == $currentYear) {
            $total_days = date('d');
        } elseif ($monthPar == 0 && $yearPar == 0) {
            $monthPar = date("m", $join_at);
            $yearPar = date("Y", $join_at);
            $total_days = floor((time() - $join_at) / (60 * 60 * 24));
        } else {
            $total_days = cal_days_in_month(CAL_GREGORIAN, $monthPar, $yearPar);
        }
    
        $options = [];
        while ($currTime >= $join_at) {
            $options[] = [
                'value' => "?month=" . date('m', $currTime) . "&year=" . date('Y', $currTime),
                'text' => date('m/Y', $currTime),
                'selected' => ($monthPar == date('n', $currTime) && $yearPar == date('Y', $currTime)),
            ];
            $currTime = strtotime('-1 month', $currTime);
        }
        $startDate = date('Y-m-01', strtotime("$year-$month-01"));
        if ($year == date('Y') && $month == date('m')) {
            // Nếu là tháng hiện tại, đặt endDate là ngày hiện tại
            $endDate = date('Y-m-d');
        } else {
            // Nếu không, đặt endDate là ngày cuối cùng của tháng
            $endDate = date('Y-m-t', strtotime($startDate));
        }
                
        // Tạo mảng chứa tất cả các ngày trong khoảng thời gian
        $allDates = [];
        $currentDate = $startDate;
        
        while (strtotime($currentDate) <= strtotime($endDate)) {
            $allDates[] = $currentDate;
            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }
        
        $report = $user->STUstats
                       ->where('date', '>=', $startDate)
                       ->where('date', '<=', $endDate)
                       ->groupBy('date');
        $total_clicks = 0;
        $total_revenue = 0;
        $_report = [];
        
        foreach ($allDates as $date) {
            if (isset($report[$date])) {
                $clicks = $report[$date]->sum('clicks');
                $revenue = $report[$date]->sum('revenue');
                $cpm = $clicks > 0 ? ($revenue / $clicks) * 1000 : 0;
            } else {
                // Nếu không có dữ liệu cho ngày đó
                $clicks = 0;
                $revenue = 0;
                $cpm = 0;
            }
        
            $_report[$date] = [
                'date' => $date,
                'clicks' => $clicks,
                'revenue' => $revenue,
                'cpm' => $cpm,
            ];
        
            $total_clicks += $clicks;
            $total_revenue += $revenue;
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
        $cpm = round($cpm, 3);

        return [
            'report' => $_report,
            'paginatedReport' => $paginatedReport,
            'total_clicks' => $total_clicks,
            'total_revenue' => $total_revenue,
            'cpm' => $cpm,
            'time' => [
                'total_days' => $total_days,
                'month' => $monthPar,
                'year' => $yearPar
            ],
            'options' => $options
        ];
    }
    public function adminIndex($request)
    {
        $start = $request->query('startDate');
        $end = $request->query('endDate');

        if(!isset($start) || !isset($end) || empty($start) || empty($end)) {
            $startDate = Carbon::now()->firstOfMonth();
            $endDate = Carbon::now();
        } else {
            $startDate = Carbon::parse($request->query('startDate'))->startOfDay();
            $endDate = Carbon::parse($request->query('endDate'))->endOfDay();
        }

        $users = $this->userRepository->getByCondition([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        $withdraws = $this->withdrawRepository->getByCondition([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);

        $report = $this->STUStatisticRepository->getStatsBetweenDates($startDate, $endDate);
        
        $STU = $this->STURepository->getByCondition([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        $NOTE = $this->NOTERepository->getByCondition([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        
        $popular_STU = $this->STURepository->getPopularBetween($startDate, $endDate, ['user'], ['total_clicks', 'desc'], $request->url());
        
        $total_clicks = 0;
        $total_revenue = 0;

        foreach ($report as $key=>$value) {
            $total_clicks += $value->clicks;
            $total_revenue += $value->revenue;
        }

        $cpm = $total_clicks > 0 ? (($total_revenue / $total_clicks) * 1000) : 0;

        $total_revenue = round($total_revenue, 3);
        $cpm = round($cpm, 3);
        $data_chart = convertChartData($report, $startDate, $endDate);

        return [
            'report' => $report,
            'withdraws' => [
                'data' => $withdraws,
                'new' => [
                    'total' => $withdraws->count(),
                    'total_amount' => $withdraws->sum('amount'),
                ],
                'pending' => [
                    'total' => $withdraws->where('status', '=', 0)->count() + $withdraws->where('status', '=', 1)->count(),
                    'total_amount' => $withdraws->where('status', '=', 0)->sum('amount') + $withdraws->where('status', '=', 1)->sum('amount'),
                ],
                'successful' => [
                    'total' => $withdraws->where('status', '=', 2)->count(),
                    'total_amount' => $withdraws->where('status', '=', 2)->sum('amount'),
                ],
                'failed' => [
                    'total' => $withdraws->where('status', '=', 3)->count(),
                    'total_amount' => $withdraws->where('status', '=', 3)->sum('amount'),
                ],
            ],
            'users' => [
                'data' => $users,
                'new' => $users->count()
            ],
            'links' => [
                'stu' => [
                    'new' => $STU->count(),
                    'popular' => $popular_STU
                ],
                'note' => [
                    'data' => $NOTE,
                    'new' => $NOTE->count()
                ]
            ],
            'total_clicks' => $total_clicks,
            'total_revenue' => $total_revenue,
            'cpm' => $cpm,
            'date' => [
                'startDate' => $endDate,
                'endDate' => $endDate,
                'total_days' => calcDaysBetween($startDate, $endDate)
            ],
            'dataChart' => [
                'stats' => $data_chart
            ]
        ];
    }
}

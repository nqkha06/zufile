<?php

namespace App\Services\Admin;

use App\Services\Admin\Interfaces\DashboardServiceInterface;
use App\Repositories\Interfaces\STUStatisticRepositoryInterface as STUStatisticRepository;
use App\Repositories\Interfaces\NOTEStatisticRepositoryInterface as NOTEStatisticRepository;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
use App\Repositories\Interfaces\NOTERepositoryInterface as NOTERepository;
use Carbon\Carbon;

/**
 * Class DashboardService
 * @package App\Services
 */
class DashboardService implements DashboardServiceInterface
{
    protected $STUStatisticRepository;
    protected $NOTEStatisticRepository;
    protected $withdrawRepository;
    protected $userRepository;
    protected $STURepository;
    protected $NOTERepository;

    public function __construct(
        STUStatisticRepository $STUStatisticRepository,
        NOTEStatisticRepository $NOTEStatisticRepository,
        WithdrawRepository $withdrawRepository,
        UserRepository $userRepository,
        STURepository $STURepository,
        NOTERepository $NOTERepository,
        )
    {
        $this->STUStatisticRepository = $STUStatisticRepository;
        $this->NOTEStatisticRepository = $NOTEStatisticRepository;
        $this->withdrawRepository = $withdrawRepository;
        $this->userRepository = $userRepository;
        $this->STURepository = $STURepository;
        $this->NOTERepository = $NOTERepository;
    }
    
    public function index($request)
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

        $STULinks = $this->STURepository->getByCondition(
            [['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        $NOTELinks = $this->NOTERepository->getByCondition(
            [['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);

        $users = $this->userRepository->getByCondition([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        $withdraws = $this->withdrawRepository->getByCondition([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);

        $STUStats = $this->STUStatisticRepository->getStatsBetweenDates($startDate, $endDate);
        $NOTEStats = $this->NOTEStatisticRepository->getStatsBetweenDates($startDate, $endDate);

        $popular_STU = $this->STURepository->getPopularBetween($startDate, $endDate, ['user', 'level'], ['total_clicks', 'desc'], $request->url());
        $merged = $STUStats->concat($NOTEStats)
        ->groupBy('date')
        ->map(function($items, $date) {
            return (object) [
                'date' => $date,
                'clicks' => $items->sum('clicks'),
                'revenue' => $items->sum('revenue'),
            ];
        })->values();
    
        $popular_NOTE = $this->NOTERepository->getPopularBetween($startDate, $endDate, [], ['total_clicks', 'desc'], $request->url());

        $data_chart = convertChartStats($STUStats, $NOTEStats, $startDate, $endDate);

        return collect([
            'stats' => [
                'STU' => $STUStats,
                'NOTE' => $NOTEStats,
            ],
            'links' => [
                'STU' => $STULinks,
                'NOTE' => $NOTELinks,
                'popSTU' => $popular_STU,
                'popNOTE' => $popular_NOTE
            ],
            'wd' => $withdraws,
            'report' => $STUStats,
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
            'date' => [
                'startDate' => $endDate,
                'endDate' => $endDate,
                'total_days' => calcDaysBetween($startDate, $endDate)
            ],
            'dataChart' => [
                'stats' => $data_chart
            ]
        ]);
    }
}

<?php

namespace App\Services\Admin;

use App\Models\NoteAnalysis;
use App\Repositories\Interfaces\STUStatisticRepositoryInterface as STUStatisticRepository;
use App\Repositories\Interfaces\NOTEStatisticRepositoryInterface as NOTEStatisticRepository;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
use App\Repositories\Interfaces\NOTERepositoryInterface as NOTERepository;
use Carbon\Carbon;
use App\Models\StuAnalysis;

/**
 * Class DashboardService
 * @package App\Services
 */
class DashboardService
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

        $STULinks = $this->STURepository->findMany(
            [['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        $NOTELinks = $this->NOTERepository->findMany(
            [['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        $newSTULinks = $this->STURepository->query()
            ->selectRaw('count(*) as count, level_id')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('level_id')
            ->get();

        $newNOTELinks = $this->NOTERepository->query()
            ->selectRaw('count(*) as count, level_id')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('level_id')
            ->get();
        $users = $this->userRepository->findMany([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);
        $withdraws = $this->withdrawRepository->findMany([['created_at', '>=', $startDate], ['created_at', '<=', $endDate]]);

        // $STUStats = $this->STUStatisticRepository->getStatsBetweenDates($startDate, $endDate);
        // $NOTEStats = $this->NOTEStatisticRepository->getStatsBetweenDates($startDate, $endDate);
        $STUStats = StuAnalysis::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('count(*) as clicks, SUM(revenue) as revenue ,DATE(created_at) as date')
            ->groupBy('date')
            ->orderBy('created_at', 'asc')
            ->get();
        $NOTEStats = NoteAnalysis::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('count(*) as clicks, SUM(revenue) as revenue ,DATE(created_at) as date')
            ->groupBy('date')
            ->orderBy('created_at', 'asc')
            ->get();
        $STUStatsLevel = StuAnalysis::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('count(*) as clicks, SUM(revenue) as revenue ,level_id')
            ->groupBy('level_id')
            ->orderBy('created_at', 'asc')
            ->get();
        $NOTEStatsLevel = NoteAnalysis::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('count(*) as clicks, SUM(revenue) as revenue ,level_id')
            ->groupBy('level_id')
            ->orderBy('created_at', 'asc')
            ->get();
        $popular_STU = StuAnalysis::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('count(*) as clicks, SUM(revenue) as revenue ,level_id, link_id')
            ->groupBy('link_id')
            ->orderBy('clicks', 'asc')
            ->with(['link', 'level'])
            ->take(10)
            ->get();

        $merged = $STUStats->concat($NOTEStats)
        ->groupBy('date')
        ->map(function($items, $date) {
            return (object) [
                'date' => $date,
                'clicks' => $items->sum('clicks'),
                'revenue' => $items->sum('revenue'),
            ];
        })->values();

        $popular_NOTE = NoteAnalysis::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('count(*) as clicks, SUM(revenue) as revenue ,level_id, link_id')
            ->groupBy('link_id')
            ->orderBy('clicks', 'asc')
            ->with(['link', 'level', 'user'])
            ->take(10)
            ->get();
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
            ],
            'level' => [
                'STU' => $STUStatsLevel,
                'NOTE' => $NOTEStatsLevel,
                'new' => [
                    'STU' => $newSTULinks,
                    'NOTE' => $newNOTELinks,
                ]
            ]
        ]);
    }
}

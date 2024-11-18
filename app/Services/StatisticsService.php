<?php

namespace App\Services;

use App\Services\Interfaces\StatisticsServiceInterface;
use App\Services\BaseService;

use App\Repositories\Interfaces\NOTEStatisticRepositoryInterface as StatisticsRepository;


/**
 * Class StatisticsService
 * @package App\Services
 */
class StatisticsService implements StatisticsServiceInterface
{
    protected $statisticsRepository;

    public function __construct(StatisticsRepository $statisticsRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
    }

    public function getStatistics($user_id)
    {
        $data = $this->statisticsRepository->getStatistics($user_id);
       
        return [
            'total_clicks' => $data->total_clicks,
            'total_revenue' => $data->total_revenue,
        ];
    }

    public function getStatisticsForMonth($user_id, $get_month, $get_year) {
        $data = $this->statisticsRepository->getStatisticsForMonth($user_id, $get_year, $get_month)->toArray();

        $report = $data;

        $total_clicks = 0;
        $total_revenue = 0;

        foreach ($data as $key=>$value) {
            $total_clicks += $value->clicks;
            $total_revenue += $value->revenue;
        }

        $cpm = $total_clicks > 0 ? (($total_revenue / $total_clicks) * 1000) : 0;

        $total_revenue = round($total_revenue, 3);
        $cpm = round($cpm, 3);
        
        return [
            'report' => $report,
            'total_clicks' => $total_clicks,
            'total_revenue' => $total_revenue,
            'cpm' => $cpm
        ];
    }
}

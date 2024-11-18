<?php

namespace App\Repositories;

// use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\NOTEStatisticRepositoryInterface;
use App\Models\NOTEStatistics;
use Illuminate\Support\Facades\DB;

/**
 * Class NOTEStatisticRepository.
 */
class NOTEStatisticRepository extends BaseRepository implements NOTEStatisticRepositoryInterface
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;
    public function __construct(NOTEStatistics $model = null) {
        $this->model = $model;
    }
    public function getStatistics($user_id = null)
    {
        $query = DB::table('stu_link_clicks')
        ->select(
            DB::raw('COALESCE(SUM(revenue), 0) as total_revenue'),
            DB::raw('COALESCE(SUM(clicks), 0) as total_clicks')
        )
        ->join('stu_links', 'stu_link_clicks.link_id', '=', 'stu_links.id');
        if (!empty($user_id)) {
            $query = $query->where('stu_links.user_id', $user_id);
        }
        return $query->first();
    }
    public function getStatisticsForMonth($user_id = null, $month, $year)
    {
        $query = DB::table('note_statistics as sc')
        ->select(DB::raw('DATE(sc.date) as date'), DB::raw('SUM(sc.clicks) as clicks'), DB::raw('SUM(sc.revenue) as revenue'))
        ->join('stu_links as sl', 'sc.link_id', '=', 'sl.id');
        if (!empty($user_id)) {
            $query = $query->where('sl.user_id', $user_id);
        }
        $query = $query->whereYear('date', $month)
        ->whereMonth('date', $year)
        ->groupBy(DB::raw('DATE(sc.date)'))
        ->orderBy('date', 'asc')
        ->get();
        return $query;
    }
    public function getStatsBetweenDates($startDate, $endDate)
    {
        $query = DB::table('note_statistics as sc')
        ->select(DB::raw('DATE(sc.date) as date'), DB::raw('SUM(sc.clicks) as clicks'), DB::raw('SUM(sc.revenue) as revenue'))
        ->join('stu_links as sl', 'sc.link_id', '=', 'sl.id')->whereDate('date', '>=', $startDate)
        ->whereDate('date', '<=', $endDate)
        ->groupBy(DB::raw('DATE(sc.date)'))
        ->orderBy('date', 'asc')
        ->get();
        return $query;
    }
    public function updateOrInsertStatsByAttr(array $attrs = [], $click_value = 0)
    {
        $check = $this->model->firstOrNew($attrs);

        if (!$check->exists) {
            $check->clicks = 1;
            $check->revenue = $click_value;
            $check->save();
        } else {
            $check->increment('clicks');
            $check->increment('revenue', $click_value);
        }
    }
}

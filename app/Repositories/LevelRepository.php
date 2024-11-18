<?php

namespace App\Repositories;

use App\Models\Level;
use App\Repositories\Interfaces\LevelRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class LevelRepository.
 */
class LevelRepository extends BaseRepository implements LevelRepositoryInterface
{
    protected $model;

    public function __construct(Level $model)
    {
        $this->model = $model;
    }
    public function pubLevel()
    {
       return $this->model->where('status', 1)->get();
    }

    public function findRevenueStats(array $column = ['*'], $sreach, $orderBy)
    {
        return $this->model->select('levels.id as level_id', 'levels.name as level_name')
            ->join('stu_links', 'levels.id', '=', 'stu_links.level_id')
            ->join('stu_link_clicks', 'stu_links.id', '=', 'stu_link_clicks.link_id')
            ->selectRaw('SUM(stu_link_clicks.revenue) as total_revenue')
            ->groupBy('levels.id', 'levels.name')
            ->orderBy('total_revenue', 'desc')
            ->get();
    }
}

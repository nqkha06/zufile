<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\AccessRepositoryInterface;

use App\Models\DownloadAccesses;
use Illuminate\Support\Facades\DB;


/**
 * Class AccessRepository.
 */
class AccessRepository extends BaseRepository implements AccessRepositoryInterface
{
    protected $model;

    public function __construct(DownloadAccesses $model) {
        $this->model = $model;
    }
    /**
     * @return string
     *  Return the model
     */
    public function getAllAccessesPaginated(
        $column = ['*'],
        array $date,
        $group,
        array $order = [],
        array $conditions
    ){
        $query = $this->applyFilterConditions($conditions)
        ->select($group[0])
        ->select($column)
        ->selectRaw('sum(revenue) as revenue')
        ->selectRaw('count(*) as clicks')
        ->whereDate('created_at', '>=', $date[0])
        ->whereDate('created_at', '<=', $date[1])
        ->groupBy($group)
        ->orderBy($order[0], $order[1])
        ->paginate(10)->withQueryString()->withPath(url()->current());

        return $query;
    }

    public function getRealTimeAccesseMinutes(int $minutes = 30)
    {
        $query = $this->model
        ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d %H:%i') as minute_time"), DB::raw('COUNT(*) as total_views'))
        ->where('created_at', '>=', now()->subMinutes($minutes))
        ->groupBy('minute_time')
        ->orderBy('minute_time')
        ->get();

        return $query;
    }

}

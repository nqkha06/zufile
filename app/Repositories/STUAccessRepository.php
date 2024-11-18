<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\STUAccessRepositoryInterface;

use App\Models\StuAnalysis;
use Illuminate\Support\Facades\DB;


/**
 * Class STUAccessRepository.
 */
class STUAccessRepository extends BaseRepository implements STUAccessRepositoryInterface
{
    protected $model;

    public function __construct(StuAnalysis $model) {
        $this->model = $model;
    }
    /**
     * @return string
     *  Return the model
     */
    public function getAccessedByCondition(
        array $condition,
        string $date,
        array $relation = []
    ) {
        $query = $this->model->with($relation)->newQuery();
        foreach($condition as $key => $val){
            $query->where($val[0], $val[1] , $val[2]);
        }
        return $query->whereDate('created_at', $date)->get();
    }
    public function getAccessByCondition(
        array $condition,
        array $column = ['*'],
        string $groupBy = '',
        array $orderBy = ['id', 'desc'],
        array $relation = []
    ) {
        $query = $this->model->with($relation)->select($column);
        foreach($condition as $key => $val){
            $query->where($val[0], $val[1] , $val[2]);
        }
        return $query->groupBy($groupBy)->orderBy($orderBy[0], $orderBy[1])->paginate(10);
    }
    public function sumAccessByCondition(
        array $condition,
        string $column = ''
    ) {
        $query = $this->model->selectRaw($column);
        foreach($condition as $key => $val){
            $query->where($val[0], $val[1] , $val[2]);
        }
        return $query->first();
    }
    public function getStatsBetweenDates(
        $column = ['*'],
        array $date,
        $group,
        array $order = [],
        array $relation = []
    ){
        $query = $this->model
        ->select($column. ' as label', DB::raw('sum(revenue) as revenue'), DB::raw('count(*) as clicks'))
        ->whereDate('created_at', '>=', $date[0])
        ->whereDate('created_at', '<=', $date[1])
        ->with($relation)
        ->groupBy($group)
        ->orderBy($order[0], $order[1])
        ->paginate(10)->withQueryString()->withPath(url()->current());

        return $query;
    }
}

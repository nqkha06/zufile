<?php

namespace App\Services\Admin;
use Illuminate\Support\Facades\DB;

use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
use App\Repositories\Interfaces\STUAccessRepositoryInterface as STUAccessRepository;
use App\Repositories\Interfaces\STUStatisticRepositoryInterface as STUStatisticRepository;

/**
 * Class STUService
 * @package App\Services
 */
class STUService
{
    protected $STURepository;
    protected $STUAccessRepository;
    protected $STUStatisticRepository;

    public function __construct(
        STURepository $STURepository,
        STUAccessRepository $STUAccessRepository,
        STUStatisticRepository $STUStatisticRepository
    )
    {
        $this->STURepository = $STURepository;
        $this->STUAccessRepository = $STUAccessRepository;
        $this->STUStatisticRepository = $STUStatisticRepository;
    }

    public function listAllpaginated($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15)
    {
        function splitString($s) {
            $pattern = '/([<>]=?|=)(\d+(?:[\.,]?\d+)?)/';
            if (preg_match($pattern, $s, $matches)) {
                return [$matches[1], str_replace(',', '.', $matches[2])];
            } else {
                return [null, null];
            }
        }

        $search = [];
        if (!empty($searchParams['start_date']) && !empty($searchParams['end_date'])) {
            $search[] = ['created_at', 'date >=', startOfDay($searchParams['start_date'])];
            $search[] = ['created_at', 'date <=', endOfDay($searchParams['end_date'])];
        }
        if (!empty($searchParams['keyword'])) {
            $search[] = ['alias', 'like', '%'.$searchParams['keyword'].'%'];
            $search[] = ['status', 'ORlike', '%'.$searchParams['keyword'].'%'];
        }
        if (!empty($searchParams['user'])) {
            $search[] = ['user_id', '=', $searchParams['user']];
        }
        if (!empty($searchParams['status'])) {
            $search[] = ['status', '=', $searchParams['status']];
        }
        if (!empty($searchParams['level'])) {
            $search[] = ['level_id', '=', $searchParams['level']];
        }

        if (!empty($searchParams['view']) || !empty($searchParams['revenue'])) {
            list($view_operator, $view_amount) = splitString($searchParams['view']);
            list($revenue_operator, $revenue_amount) = splitString($searchParams['revenue']);

            if (!empty($view_amount) && !empty($view_operator)) {
                $search[] = ['stats', 'has', function ($query) use ($view_operator, $view_amount) {
                    $query->having(DB::raw('sum(clicks)'), $view_operator, $view_amount);
                }];
            }
            if (!empty($revenue_amount) && !empty($revenue_operator)) {
                $search[] = ['stats', 'has', function ($query) use ($revenue_operator, $revenue_amount) {
                    $query->having(DB::raw('sum(revenue)'), $revenue_operator, $revenue_amount);
                }];
            }
        }

        $links = $this->STURepository->with(['level', 'stats', 'user'])->getAllPaginated($search);

        return $links;
    }

    public function listOwnSTUPaginated($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15)
    {
        $search = [
            ['user_id', '=', request()->user()->id],
            ['status', '!=', 'deleted']
        ];

        if (!empty($searchParams['keyword'])) {
            $keyword = $searchParams['keyword'];
            $search[] = ['alias', 'like', '%'.$keyword.'%'];
        }
        if (!empty($searchParams['created_at'])) {
            $created_at = $searchParams['created_at'];
            $search[] = [DB::raw('date(created_at)'), '=', $created_at];
        }
        if (!empty($searchParams['level'])) {
            $level = $searchParams['level'];
            $search[] = ['level_id', '=', $level];
        }

        return $this->STURepository->with(['level.translations', 'stats', 'level'])->getAllPaginated($search, $perPage);
    }

    public function getLink($alias) {
        return $this->STURepository->findLinkActive($alias);
    }

    public function deleteOwnSTU(string $alias, $user_id)
    {
        DB::beginTransaction();
        try{
            $this->STURepository->deleteOwnSTU($alias, $user_id);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            return false;
        }
    }

    public function deleteAny(string $alias)
    {
        DB::beginTransaction();
        try{
            $this->STURepository->deleteAny($alias);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function restoreSTU(string $alias)
    {
        DB::beginTransaction();
        try{
            $this->STURepository->restore($alias);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            return false;
        }
    }

    public function listAllPopularPaginated($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15) {
        $search = [];
        if (!empty($searchParams['start_date']) && !empty($searchParams['end_date'])) {
            $search[] = ['created_at', 'date >=', startOfDay($searchParams['start_date'])];
            $search[] = ['created_at', 'date <=', endOfDay($searchParams['end_date'])];
        }
        if (!empty($searchParams['keyword'])) {
            $search[] = ['alias', 'like', '%'.$searchParams['keyword'].'%'];
            $search[] = ['status', 'ORlike', '%'.$searchParams['keyword'].'%'];
        }
        if (!empty($searchParams['username'])) {
            $search[] = ['user', 'has', function ($query) use ($searchParams) {
                $query->where('name', 'like', '%'.$searchParams['username'].'%');
            }];
        }
        if (!empty($searchParams['status'])) {
            $search[] = ['status', '=', $searchParams['status']];
        }
        if (!empty($searchParams['level_id'])) {
            $search[] = ['level_id', '=', $searchParams['level_id']];
        }

        $links = $this->STURepository->with(['level', 'stats', 'user' => function ($query) {
            $query->select('id', 'name');
        }])->withCount(['stats as total_views' => function ($query) use ($searchParams) {
            $query->select(DB::raw("SUM(clicks)"));
            if (!empty($searchParams['start_date']) && !empty($searchParams['end_date'])) {
                $query->whereBetween(DB::raw('date(created_at)'), [$searchParams['start_date'], $searchParams['end_date']]);
            }
        }])->getAllPaginated([
            'conditions' => $search,
            'sort' => [['total_views', 'desc'], [$sortBy ?? 'created_at', $sortOrder ?? 'desc']]
        ]);

        return $links;
    }

    public function updateSTU(string $id, array $payload = []): bool {
        DB::beginTransaction();
        try{
            $this->STURepository->update($id, $payload);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            return false;
        }
    }
}

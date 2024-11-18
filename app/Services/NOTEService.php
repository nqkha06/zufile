<?php

namespace App\Services;

use App\Services\Interfaces\NOTEServiceInterface;
use App\Repositories\Interfaces\NOTERepositoryInterface as NOTERepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class NOTEService
 * @package App\Services
 */
class NOTEService implements NOTEServiceInterface
{
    protected $NOTERepository;

    public function __construct(NOTERepository $NOTERepository)
    {
        $this->NOTERepository = $NOTERepository;
    }
    public function index($request)
    {
        $user = $request->user();

        $keyword = addslashes($request->input('keyword'));
        $created_at = addslashes($request->input('created_at'));
        $level = addslashes($request->input('level'));

        $condition['where'] = [['user_id', '=', $user->id], ['status', '=', 'active']];
        if (!empty($created_at)) {
            $condition['where'][] = [DB::raw('date(created_at)'), '=', $created_at];
        }
        if (!empty($keyword)) {
            $condition['where'][] = ['alias', 'LIKE', ('%'.$keyword.'%')];
            $condition['orWhere'][] = ['title', 'LIKE', ('%'.$keyword.'%')];
            $condition['orWhere'][] = ['content', 'LIKE', ('%'.$keyword.'%')];
        }
        if (!empty($level) && $level != -1) {
            $condition['where'][] = ['level_id', '=', $level];
        }
        
        $links = $this->NOTERepository->pagination(['*'], $condition);

        return $links;
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
        if (!empty($searchParams['username'])) {
            $search[] = ['user', 'has', function ($query) use ($searchParams) {
                $query->where('name', 'like', '%'.$searchParams['username'].'%');
            }];
        }
        if (!empty($searchParams['status'])) {
            $search[] = ['status', '=', $searchParams['status']];
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
 
        $links = $this->NOTERepository->with(['stats', 'user'])->getAllPaginated($search);

        return $links;
    }

    public function softDeleteOwn($alias)
    {
        DB::beginTransaction();
        try{
            $this->NOTERepository->softDeleteOwn($alias, Auth::user()->id);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            // echo $e->getMessage();die();
            return false;
        }
    }

    public function softDeleteAny($alias)
    {
        DB::beginTransaction();
        try{
            $this->NOTERepository->softDeleteAny($alias);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            // echo $e->getMessage();die();
            return false;
        }
    }

    public function restore(string $alias)
    {
        DB::beginTransaction();
        try{
            $this->NOTERepository->restore($alias);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            // echo $e->getMessage();die();
            return false;
        }
    }
}

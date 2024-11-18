<?php

namespace App\Services;

use App\Repositories\Interfaces\NOTELevelRepositoryInterface as NOTELevelRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Class NOTELevelService
 * @package App\Services
 */
class NOTELevelService
{
    protected $NOTELevelRepository;

    public function __construct(NOTELevelRepository $NOTELevelRepository)
    {
        $this->NOTELevelRepository = $NOTELevelRepository;
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
 
        $links = $this->NOTELevelRepository->getAllPaginated($search);

        return $links;
    }

    public function create($payload)
    {
        $note = $this->NOTELevelRepository->create($payload);

        return $note;
    }

    public function updateNoteLevel($id, $payload)
    {
        //update..
    }
    public function deleteNoteLevel($alias)
    {
        DB::beginTransaction();
        try{
            $this->NOTELevelRepository->delete($alias);

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

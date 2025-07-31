<?php

namespace App\Services;

use App\Repositories\Interfaces\LevelRepositoryInterface as LevelRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class STULevelService
 * @package App\Services
 */
class STULevelService
{
    protected $levelRopistory;

    public function __construct(LevelRepository $levelRopistory) {
        $this->levelRopistory = $levelRopistory;
    }

    public function getPaginatedWidgets($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15)
    {
        $search = [];
        if (!empty($searchParams['keyword'])) {
            $keyword = $searchParams['keyword'];

            $search[] = ['user', 'HAS', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            }];
            $search[] = ['payment_method', 'ORlike', '%'.$keyword.'%'];
            $search[] = ['payment_account_number', 'ORlike', '%'.$keyword.'%'];
            $search[] = ['payment_account_name', 'ORlike', '%'.$keyword.'%'];
            $search[] = ['payment_bank_name', 'ORlike', '%'.$keyword.'%'];
            $search[] = ['costs', 'ORlike', '%'.$keyword.'%'];
            $search[] = ['amount', 'ORlike', '%'.$keyword.'%'];
            $search[] = ['id', 'ORlike', '%'.$keyword.'%'];

        }

        if (!empty($searchParams['type']) || !empty($searchParams['type']) && $searchParams['type'] == 0) {
            $type = $searchParams['type'];
            if ($type == 1 || $type == 0) {
                $search[] = ['type', '=', $type];
            }
        }

        if (!empty($searchParams['status'])) {
            $status = $searchParams['status'];
            $search[] = ['status', '=', $status];
        }

        if (!empty($searchParams['method'])) {
            $payment_method = $searchParams['method'];
            $search[] = ['payment_method', '=', $payment_method];
        }

        return $this->levelRopistory->getAllPaginated($search);
    }
    public function getAll() {
        DB::beginTransaction();
        $levels = $this->levelRopistory->getAll();
        return $levels;
    }
}

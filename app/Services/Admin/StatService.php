<?php

namespace App\Services\Admin;

use App\Services\Admin\Interfaces\StatServiceInterface;
use App\Repositories\Interfaces\LevelRepositoryInterface as LevelRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class StatService
 * @package App\Services\Admin
 */
class StatService implements StatServiceInterface
{
    protected $LevelRepository;

    public function __construct(LevelRepository $LevelRepository = null) {
        $this->LevelRepository = $LevelRepository;
    }

    public function getAllLevelStats($searchParams) {
        $data = $this->LevelRepository->findRevenueStats(['123'], 12, 3232);

        return $data;
    }

}

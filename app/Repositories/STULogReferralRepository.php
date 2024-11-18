<?php

namespace App\Repositories;

use App\Repositories\Interfaces\STULogReferralRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\StuLogReferral;

/**
 * Class STULogReferralRepository.
 */
class STULogReferralRepository extends BaseRepository implements STULogReferralRepositoryInterface
{
    protected $model;

    public function __construct(StuLogReferral $model) {
        $this->model = $model;
    }
}

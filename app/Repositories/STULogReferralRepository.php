<?php

namespace App\Repositories;

use App\Repositories\Interfaces\STULogReferralRepositoryInterface;
use App\Repositories\Abstracts\BaseRepositoryAbstract;
use App\Models\StuLogReferral;

/**
 * Class STULogReferralRepository.
 */
class STULogReferralRepository extends BaseRepositoryAbstract implements STULogReferralRepositoryInterface
{
    protected $model;

    public function __construct(StuLogReferral $model) {
        parent::__construct($model);
    }
}

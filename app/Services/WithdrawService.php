<?php

namespace App\Services;

use App\Services\Interfaces\WithdrawServiceInterface;
use App\Services\BaseService;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;

/**
 * Class WithdrawService
 * @package App\Services
 */

class WithdrawService implements WithdrawServiceInterface
{
    protected $withdrawRepository;

    public function __construct(WithdrawRepository $withdrawRepository) {
        $this->withdrawRepository = $withdrawRepository;
    }
}

<?php

namespace App\Services;

use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;

/**
 * Class InvoiceService
 * @package App\Services
 */
class InvoiceService
{
    protected $withdrawRopistory;

    public function __construct(WithdrawRepository $withdrawRopistory) {
        $this->withdrawRopistory = $withdrawRopistory;
    }

    public function getPaginatedInvoices($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15)
    {
        $search = [];

        if (!empty($searchParams['type'])) {
            if ($searchParams['type'] == 'fast') {
                $type = 1;
            } else {
                $type = 0;
            }
            $search[] = ['type', '=', $type];
        }

        if (!empty($searchParams['status'])) {
            $status = $searchParams['status'];
            $search[] = ['status', '=', $status];
        }
        if (!empty($searchParams['user'])) {
            $user = $searchParams['user'];
            $search[] = ['user_id', '=', $user];
        }

        if (!empty($searchParams['method'])) {
            $payment_method = $searchParams['method'];
            $search[] = ['payment_method', '=', $payment_method];
        }

        if (!empty($searchParams['keyword'])) {
            $keyword = $searchParams['keyword'];

            $search[] = ['payment_method', 'like', '%'.$keyword.'%'];
            $search[] = ['payment_details', 'ORlike', '%'.$keyword.'%'];
            $search[] = ['costs', 'ORlike', '%'.$keyword.'%'];
            $search[] = ['amount', 'ORlike', '%'.$keyword.'%'];
            $search[] = ['id', 'ORlike', '%'.$keyword.'%'];

        }

        return $this->withdrawRopistory->with(['user'])->getAllPaginated($search);
    }

}

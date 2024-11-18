<?php

namespace App\Services;

use App\Services\Interfaces\InvoiceServiceInterface;
use App\Repositories\Interfaces\WithdrawRepositoryInterface as WithdrawRepository;

/**
 * Class InvoiceService
 * @package App\Services
 */
class InvoiceService implements InvoiceServiceInterface
{
    protected $withdrawRopistory;

    public function __construct(WithdrawRepository $withdrawRopistory) {
        $this->withdrawRopistory = $withdrawRopistory;
    }

    public function getPaginatedInvoices($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15)
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

        if (!empty($searchParams['method'])) {
            $payment_method = $searchParams['method'];
            $search[] = ['payment_method', '=', $payment_method];
        }

        return $this->withdrawRopistory->with(['user'])->getAllPaginated($search);
    }

}

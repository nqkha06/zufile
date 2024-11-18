<?php

namespace App\Services\Interfaces;

/**
 * Interface InvoiceServiceInterface
 * @package App\Services\Interfaces
 */
interface InvoiceServiceInterface
{
    public function getPaginatedInvoices($searchParams = null, $sortBy = 'created_at', $sortOrder = 'desc', $perPage = 15);
}

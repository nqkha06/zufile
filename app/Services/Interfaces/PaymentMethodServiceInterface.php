<?php

namespace App\Services\Interfaces;

/**
 * Interface PaymentMethodServiceInterface
 * @package App\Services\Interfaces
 */
interface PaymentMethodServiceInterface
{
    public function listAllPaginated($filterParams);
    public function create($payload);
    public function findOrFail($value, ?string $column = null);
    public function update(int $id = 0, array $payload = []);
}

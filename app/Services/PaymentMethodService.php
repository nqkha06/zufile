<?php

namespace App\Services;

use App\Services\Interfaces\PaymentMethodServiceInterface;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface as PaymentMethodRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class PaymentMethodService
 * @package App\Services
 */
class PaymentMethodService implements PaymentMethodServiceInterface
{
    protected $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }
    
    public function listAllPaginated($filterParams)
    {
        return $this->paymentMethodRepository->getAllPaginated($filterParams);
    }

    public function findOrFail($value, ?string $column = null)
    {
       return $this->paymentMethodRepository->findOrFail($value, $column);
    }

    public function create($payload)
    {
        DB::beginTransaction();
        try{
            $this->paymentMethodRepository->create($payload);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            // echo $e->getMessage();die();
            return false;
        }
    }
    public function update(int $id = 0, array $payload = [])
    {
        DB::beginTransaction();
        try{
            $this->paymentMethodRepository->update($id, $payload);

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

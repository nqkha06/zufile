<?php

namespace App\Services;

use App\Services\Interfaces\AccessServiceInterface;
use App\Repositories\Interfaces\AccessRepositoryInterface as AccessRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class AccessService
 * @package App\Services
 */
class AccessService implements AccessServiceInterface
{
    protected $accessRepository;

    public function __construct(AccessRepository $accessRepository) {
        $this->accessRepository = $accessRepository;
    }

    public function getPaginatedAccesses($searchParams)
    {
        $conditons = [];

        $dataRange = handle_date_range($searchParams['start_date'] ?? null, $searchParams['end_date'] ?? null);

        $groupBy = $searchParams['group_by'] ?? null;
        $parent = $searchParams['parent'] ?? null;

        $order = [
            $searchParams['order_by'] ?? 'clicks',
            $searchParams['order_direction'] ?? 'desc'
        ];

        $parent = $searchParams['parent'] ?? null;
        
        if (isset($searchParams['link']) && !empty($searchParams['link'])) {
            $conditons[] = ['link_id' => $searchParams['link']];
        };

        if (isset($searchParams['user']) && !empty($searchParams['user'])) {
            $conditons[] = ['user_id' => $searchParams['user']];
        };

        function buildGroup($parent, $groupBy = null) {
            if ($groupBy === null) {
                return [DB::raw('DATE(created_at)')];
            }
        
            if ($parent === 'created_at') {
                return [DB::raw('DATE('.$parent.')'), $groupBy];
            }
        
            return $parent ? [$parent, $groupBy] : [$groupBy];
        }
        
        function buildLabel($label, $group = null) {
            $labelMappings = [
                'created_at' => DB::raw('DATE('.$label.') as label'),
                'user_id' => DB::raw('(SELECT name FROM users WHERE users.id = stu_link_accesses.user_id) as label'),
                'link_id' => DB::raw('(SELECT alias FROM stu_links WHERE stu_links.id = stu_link_accesses.link_id) as label'),
            ];
        
            $label_out = $labelMappings[$label] ?? null;
        
            if ($label_out === null) {
                return $group ? [$group] : false;
            }
        
            return $group ? [$group, $label_out] : [$label_out];
        }
        

        switch ($groupBy) {
            case 'referral':
                $data = $this->accessRepository->with(['user'])->getAllAccessesPaginated(
                    buildLabel($parent, 'referral'), $dataRange, buildGroup($parent, 'referral'), $order, $conditons
                );
                break;
            case 'browser':
                $data = $this->accessRepository->with(['user'])->getAllAccessesPaginated(
                    buildLabel($parent, 'browser'), $dataRange, buildGroup($parent, 'browser'), $order, $conditons
                );  
                break;
            case 'country':
                $data = $this->accessRepository->with(['user'])->getAllAccessesPaginated(
                    buildLabel($parent, 'country'), $dataRange, buildGroup($parent, 'country'), $order, $conditons
                );  
                break;
            case 'device':
                $data = $this->accessRepository->with(['user'])->getAllAccessesPaginated(
                    buildLabel($parent, 'device'), $dataRange, buildGroup($parent, 'device'), $order, $conditons
                );  
                break;
            case 'platform':
                $data = $this->accessRepository->with(['user'])->getAllAccessesPaginated(
                    buildLabel($parent, 'platform'), $dataRange, buildGroup($parent, 'platform'), $order, $conditons
                );  
                break;
            case 'detection':
                $data = $this->accessRepository->with(['user'])->getAllAccessesPaginated(
                    buildLabel($parent, 'detection'), $dataRange, buildGroup($parent, 'detection'), $order, $conditons
                );  
                break;
            default:
                $data = $this->accessRepository->with(['user'])->getAllAccessesPaginated(
                    buildLabel($parent) ? buildLabel($parent) : DB::raw('DATE(created_at) as label'), $dataRange, buildGroup($parent), $order, $conditons
                );
                break;
        }
        
        return $data;
    }

    public function deleteAllAccess(): bool
    {
        DB::beginTransaction();
        try{
            $this->accessRepository->deleteAll();

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            return false;
        }
    }
}

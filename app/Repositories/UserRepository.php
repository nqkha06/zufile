<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    
    protected function applyFilters(array $params = []): Builder
    {
        $query = $this->getQuery();

        if (isset($params['conditions']) && !empty($params['sort'])) {
            $query = $this->applyFilterConditions($params['conditions']);
        }

        if (isset($params['sort']) && !empty($params['sort'])) {
            foreach ($params['sort'] as $sortField => $sortDirection) {
                $query->orderBy($sortField, $sortDirection);
            }
        } else {
            $orderByField = $this->defaultOrderBy ?? $this->model->getKeyName();
            $query->orderBy($orderByField, 'desc');
        }
            
        return $query;
    }
}

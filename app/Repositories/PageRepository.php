<?php

namespace App\Repositories;

use App\Repositories\Abstracts\BaseRepositoryAbstract;
use App\Repositories\Interfaces\PageRepositoryInterface;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use App\Filters\PageFilter;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class PostRepository.
 */
class PageRepository extends BaseRepositoryAbstract implements PageRepositoryInterface
{
    /**
     * PageRepository constructor.
     *
     * @param Page $model
     */
    public function __construct(Page $model) {
        parent::__construct($model);
    }

    public function getAllPaginated(array $search = [], int $pageSize = 15): LengthAwarePaginator
    {
        $filter = new PageFilter($this->getQuery(), $search);
        $this->setFilter($filter);

        return parent::getAllPaginated($search, $pageSize);
    }
}

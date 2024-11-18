<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PageRepositoryInterface;
use App\Models\Page;
use Illuminate\Support\Facades\DB;

/**
 * Class PostRepository.
 */
class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    protected $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

}

<?php

namespace App\Services;

use App\Services\Interfaces\MenuServiceInterface;
use App\Repositories\Interfaces\MenuRepositoryInterface as MenuRepository;

/**
 * Class MenuService
 * @package App\Services
 */
class MenuService implements MenuServiceInterface
{
    protected $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

}

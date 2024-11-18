<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;
/**
 * Interface NOTERepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface NOTERepositoryInterface extends BaseRepositoryInterface
{

    public function getPopularBetween(
      $startDate,
      $endDate,
      array $relation = [],
      array $orderBy = ['id', 'DESC'],
      string $path,
    );
    public function softDeleteAny($alias);
    public function softDeleteOwn($alias, $user_id);
    public function restore($alias);
}

<?php

namespace App\Repositories\Interfaces;
use App\Repositories\Interfaces\BaseRepositoryInterface;

/**
 * Interface STURepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface STURepositoryInterface extends BaseRepositoryInterface
{
    public function getLinks(
        $user_id=null
      , array $condition = []
      , $PATH
    );
    public function getLinksByAdmin(
      array $condition = [],
      array $relation = [],
      array $orderBy = ['id', 'DESC'],
      int $perPage = 10,
      string $path,
    );
    public function getPopularBetween(
      $startDate,
      $endDate,
      array $relation = [],
      array $orderBy = ['id', 'DESC'],
      string $path = '',
    );
    public function findLink(string $alias);
    public function deleteAny(string $alias);
    public function deleteOwnSTU(string $alias, $user_id);
    public function restore(string $alias);
    public function findLinkActive(string $alias);
}

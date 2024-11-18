<?php

namespace App\Services\Interfaces;

/**
 * Interface PageServiceInterface
 * @package App\Services\Interfaces
 */
interface PageServiceInterface
{
    public function listAllPagesPaginated();
    public function editPage($id);
    public function updatePage($id, $req);

}

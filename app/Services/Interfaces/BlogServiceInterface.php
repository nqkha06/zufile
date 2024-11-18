<?php

namespace App\Services\Interfaces;

/**
 * Interface BlogServiceInterface
 * @package App\Services\Interfaces
 */
interface BlogServiceInterface
{
    public function index();

    public function show($slug);
}

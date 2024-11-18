<?php

namespace App\Services\Home;
use Illuminate\Support\Facades\DB;

use App\Services\Home\Interfaces\STUServiceInterface;
use App\Repositories\Interfaces\STURepositoryInterface as STURepository;
/**
 * Class STUService
 * @package App\Services\Home
 */
class STUService implements STUServiceInterface
{
    protected $STURepository;

    public function __construct(STURepository $STURepository)
    {
        $this->STURepository = $STURepository;
    }
    public function redirect($request)
    {
        $user = $request->user();

        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['created_at'] = addslashes($request->input('created_at'));
        $condition['level'] = addslashes($request->input('level'));
        $condition['username'] = addslashes($request->input('username'));
    
        $perPage = 10;

        $links = $this->STURepository->getLinksByAdmin($condition, ['user', 'level'], ['id', 'DESC'], $perPage, '');

        return $links;
    }
}

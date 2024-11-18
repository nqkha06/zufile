<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository = null) {
        $this->userRepository = $userRepository;
    }

    public function index($request)
    {

        $keyword = addslashes($request->input('keyword'));
        $created_at = addslashes($request->input('created_at'));
        $role = addslashes($request->input('role'));

        $condition = [
            'keyword' => $keyword,
            'orWhere' => [
                ['email', 'LIKE', ('%'.$keyword.'%')],
                ['id', 'LIKE', ('%'.$keyword.'%')]
            ],
        ];
        if (!empty($created_at)) {
            $condition['where'] = [['created_at', '=', $created_at]];
        }

        $invoices = $this->userRepository->pagination(['*'], $condition, 10);

        return $invoices;
    }

}

<?php

namespace App\Services\Admin;

use App\Services\Admin\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class UserService
 * @package App\Services\Admin
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository = null) {
        $this->userRepository = $userRepository;
    }

    public function listAllPaginated($filterParams) {
        $conditions = $filterParams['conditions'];
        $sortParams = $filterParams['sort'];

        $search = [];
        $sort = [];

        if (!empty($conditions['start_date']) && !empty($conditions['end_date'])) {
            $search[] = ['created_at', 'date >=', startOfDay($conditions['start_date'])];
            $search[] = ['created_at', 'date <=', endOfDay($conditions['end_date'])];
        }

        if (isset($conditions['keyword'])) {
            $search[] = ['name', 'like', '%'.$conditions['keyword'].'%'];
            $search[] = ['email', 'ORlike', '%'.$conditions['keyword'].'%'];
        }

        if (isset($sortParams['sort_by']) && isset($sortParams['sort_direction'])) {
            $sort = [$sortParams['sort_by'] => $sortParams['sort_direction']];
        }

        $users = $this->userRepository->with(['roles'])->getAllPaginated([
            'conditions' => $search,
            'sort' => $sort
        ]);
        
        return $users;
    }

    public function getUserStats($request) {
        $keyword = addslashes($request->input('keyword'));
        $sortColumn = $request->input('sort_column') && $request->input('sort_column') != '-1' ? $request->input('sort_column') : 'balance';
        $sortDirection = $request->input('sort_direction') ? $request->input('sort_direction') : 'desc';

        $condition = [
            'keyword' => $keyword,
            'orWhere' => [
                ['email', 'LIKE', ('%'.$keyword.'%')],
                ['users.id', 'LIKE', ('%'.$keyword.'%')]
            ],
        ];

        $perPage = 10;
        $currentPage = request()->get('page', 1);
        
        $data = $this->userRepository->with(['STUstats', 'invoices'])->getAll();
        $new_data = $data->map(function ($value) {
            $total_revenue = $value->STUstats->sum('revenue');
            $total_clicks = $value->STUstats->sum('clicks');
            $total_withdraw = $value->invoices->whereNotIn('status', ['hold', 'cancelled'])->sum('amount');
            $balance = $total_revenue - $total_withdraw;
        
            return [
                'data_user' => $value,
                'data_stats' => $value->STUstats,
                'data_invoices' => $value->invoices,
                'data_metric' => [
                    'total_revenue' => $total_revenue,
                    'total_clicks' => $total_clicks,
                    'total_withdraw' => $total_withdraw,
                    'balance' => $balance,
                ]
            ];
        })->sortByDesc('data_metric.balance');
        
        $paginatedUsers = new LengthAwarePaginator(
            $new_data->forPage($currentPage, $perPage),
            $new_data->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return $paginatedUsers;
    }
    
    public function show($request, $id)
    {
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        $currentPage = $request->query('p_sats', 1);
        $perPage = 10;
        $offset = ($currentPage - 1) * $perPage;

        if (empty($startDate) || empty($endDate)) {
            $startDate = Carbon::now()->firstOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->format('Y-m-d');
        } else {
            $startDate = Carbon::parse($startDate)->format('Y-m-d');
            $endDate = Carbon::parse($endDate)->format('Y-m-d');
        }

        $user = $this->userRepository->with(['withdraw', 'STUstats', 'STUlinks', 'NOTElinks'])->findOrFail($id);

        $metric = [
            'total_pending' => $user->withdraw->where('status', 'pending')->sum('amount'),
            'total_approved' => $user->withdraw->where('status', 'approved')->sum('amount'),
            'total_completed' => $user->withdraw->where('status', 'completed')->sum('amount'),
            'total_cancelled' => $user->withdraw->where('status', 'cancelled')->sum('amount'),
            'total_hold' => $user->withdraw->where('status', 'hold')->sum('amount'),
            'total_revenue' => $user->STUstats->sum('revenue'),
            'total_views' => $user->STUstats->sum('clicks'),
        ];
        $metric['total_balance'] = $metric['total_revenue'] - $metric['total_pending'] - $metric['total_approved'] - $metric['total_completed'] - $metric['total_hold'];

        $STUstats = $user->STUstats;
        $ctSTUstats = $STUstats->where('date', '>=', $startDate)->where('date', '<=', $endDate);
        $withdraw = $user->withdraw;
        $ctWithdraw = $withdraw->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate);
        $STUlinks = $user->STUlinks;
        $ctSTUlinks = $STUlinks->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate);

        $NOTEstats = $user->NOTEstats;
        $ctNOTEstats = $NOTEstats->where('date', '>=', $startDate)->where('date', '<=', $endDate);
        $NOTElinks = $user->NOTElinks;
        $ctNOTElinks = $NOTElinks->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate);

        $yourDataArray = convertPaginData($ctSTUstats, $startDate, $endDate);
        $items = array_slice($yourDataArray, $offset, $perPage);
        $total = count($yourDataArray);

        $data = [
            'NOTE' => [
                'links' => '',
                'stats' => '',
                'cus_links' => '',
                'cus_stats' => ''
            ],
            'NOTE' => [
                'links' => '',
                'stats' => '',
                'cus_links' => '',
                'cus_stats' => ''
            ],
        ];

        return [
            'user' => $user,
            'user_metric' => $metric,
            'STUstats' => $STUstats,
            'ctSTUstats' => $ctSTUstats,
            'withdraw' => $withdraw,
            'ctWithdraw' => $ctWithdraw,
            'STUlinks' => $STUlinks,
            'ctSTUlinks' => $ctSTUlinks->sortByDesc('created_at'),
            'ctStatsTable' => new LengthAwarePaginator($items, $total, $perPage, $currentPage, [
                'path' => url()->current(),
                'pageName' => 'p_sats', 
            ]),
            'NOTEstats' => $NOTEstats,
            'ctNOTEstats' => $ctNOTEstats,
            'NOTElinks' => $NOTElinks,
            'ctNOTElinks' => $ctNOTElinks->sortByDesc('created_at'),
        ];
    }

}

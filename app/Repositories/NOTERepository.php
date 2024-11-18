<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\NOTERepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\NOTELink;

/**
 * Class NOTERepository.
 */
class NOTERepository extends BaseRepository implements NOTERepositoryInterface
{
    protected $model;

    public function __construct(NOTELink $model)
    {
        $this->model = $model;
    }

    public function getPopularBetween(
        $startDate,
        $endDate,
        array $relation = [],
        array $orderBy = ['id', 'DESC'],
        string $path,
    ){
        $query = NOTELink::select('note_links.*', DB::raw('COALESCE(SUM(note_statistics.clicks), 0) as total_clicks'), DB::raw('COALESCE(SUM(note_statistics.revenue), 0) as total_revenue'))
        ->with($relation)
        ->leftJoin('note_statistics', 'note_links.id', '=', 'note_statistics.link_id')
        ->whereBetween('note_statistics.date', [$startDate, $endDate])
        ->groupBy('note_links.id')
        ->orderBy($orderBy[0], $orderBy[1]);
        
        return $query->paginate(10, ['*'], 'note_page')->withQueryString()->withPath(url()->current());
    }

    public function softDeleteAny($alias) {
        return $this->getQuery()->whereRaw('BINARY alias = ?', [$alias])->update([
            'status' => 'deleted',
        ]);
    }
    public function softDeleteOwn($alias, $user_id) {
        return $this->getQuery()->where('user_id', $user_id)->whereRaw('BINARY alias = ?', [$alias])->update([
            'status' => 'deleted',
        ]);
    }

    public function restore($alias) {
        return $this->getQuery()->whereRaw('BINARY alias = ?', [$alias])->update([
            'status' => 'active',
        ]);
    }
}

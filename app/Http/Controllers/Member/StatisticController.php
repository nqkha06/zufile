<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DownloadAccesses as DownloadAccess;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index(Request $request)
    {

        if ($request->header('Accept') === 'application/json') {
            return response()->json($this->statistics($request->month, $request->year));
        }

        $statistics = [
            'total_earnings' => 1000,
            'total_links' => 50,
            'active_notes' => 10,
        ];

        return view('backend.member_2.statistics', compact('statistics'));
    }

    public function statistics($month = null, $year = null)
    {
        if (!$month || !$year) {
            $month = date('m');
            $year = date('Y');
        }


        $data = DownloadAccess::where('user_id', auth()->id())
            // ->select('is_earn', DB::raw('COUNT(is_earn) as total'), DB::raw('SUM(revenue) as revenue_sum'))
    ->whereMonth('created_at', $month)
    ->whereYear('created_at', $year)
    // ->groupBy('is_earn')
    ->get();
    $stats = $data->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });
    $stats = $stats->map(function ($group) {
            return [
                'download' => $group->count(),
                'unique' => $group->where('is_earn', 1)->count(),
                'adblock' => 0,
                'earn' => '$' . number_format($group->sum('revenue'), 3)
            ];
        });
        $topFiles = $data->groupBy('file_id')->map(function ($group) {
            $file = $group->first()->file; // Assuming file relationship exists
            return [
                'name' => $file?->name ?? 'Unknown File',
                'download' => [
                    'total' => $group->count(),
                    'unique' => $group->where('is_earn', 1)->count()
                ],
                'earn' => '$' . number_format($group->sum('revenue'), 3),
            ];
        })->values();
        $topFiles = $topFiles->sortByDesc('download.total')->take(10)->values()->toArray();
        return [
    'download' => [
        'unique' => $data->where('is_earn', 1)->count(),
        'total' => $data->count()
    ],
    'earn' => '$' . number_format($data->sum('revenue'), 3),
    'cpm' => '$1.50',
    'stats' => $stats,
    'files' => $topFiles,
];
    }
}

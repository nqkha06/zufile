<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        if ($request->header('Accept') === 'application/json') {
            return response()->json($this->statistics());
        }

        $statistics = [
            'total_earnings' => 1000,
            'total_links' => 50,
            'active_notes' => 10,
        ];

        return view('backend.member_2.statistics', compact('statistics'));
    }

    public function statistics()
    {
        return [
    'download' => [
        'unique' => 4,
        'total' => 8
    ],
    'earn' => '$0.006',
    'cpm' => '$1.50',
    'stats' => [
        '2025-07-1' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-2' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-3' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-4' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-5' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-6' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-7' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-8' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-9' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-10' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-11' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-12' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-13' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-14' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-15' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-16' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-17' => [
            'download' => 4,
            'unique' => 2,
            'adblock' => 0,
            'earn' => '$0.003'
        ],
        '2025-07-18' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-19' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-20' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-21' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-22' => [
            'download' => 1,
            'unique' => 1,
            'adblock' => 0,
            'earn' => '$0.0015'
        ],
        '2025-07-23' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-24' => [
            'download' => 3,
            'unique' => 1,
            'adblock' => 0,
            'earn' => '$0.0015'
        ],
        '2025-07-25' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-26' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ],
        '2025-07-27' => [
            'download' => 0,
            'unique' => 0,
            'adblock' => 0,
            'earn' => '$0.00'
        ]
    ],
    'files' => [
        [
            'name' => 'laravel (1)`.log',
            'download' => [
                'total' => 4,
                'unique' => 2
            ],
            'earn' => '$0.003'
        ],
        [
            'name' => '1702970215866-ss-b7f19b41c1e14cf053b3873db3ecc5331eb9ed0b1920x1080-1-SgIdA.jpg',
            'download' => [
                'total' => 2,
                'unique' => 0
            ],
            'earn' => '$0.00'
        ],
        [
            'name' => 'IMG_5133.png',
            'download' => [
                'total' => 1,
                'unique' => 1
            ],
            'earn' => '$0.0015'
        ],
        [
            'name' => 'Postman for macOS (arm64).zip',
            'download' => [
                'total' => 1,
                'unique' => 1
            ],
            'earn' => '$0.0015'
        ]
    ]
];
    }
}

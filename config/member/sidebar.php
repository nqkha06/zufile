<?php
// config/sidebar.php
return [
    // [
    //     'section' => null,
    //     'items' => [
    //         [
    //             'title' => 'Free Drive',
    //             'href' => '/u/drive/1/home',
    //             'icon_svg' => 'drive',
    //             'progress' => [
    //                 'used' => '71.76 MB',
    //                 'total' => '10.00 TB',
    //                 'percent' => 0.00068431151703408
    //             ]
    //         ],
    //         [
    //             'title' => 'Get more storage',
    //             'href' => '/u/upgrade',
    //             'class' => 'justify-center !text-xs border border-dashed border-zinc-300 dark:border-zinc-700'
    //         ],
    //     ],
    // ],
    [
        'section' => null,
        'items' => [
            ['title' => 'File Manager', 'href' => '/u/drive/1/home', 'icon_svg' => 'trash'],

            ['title' => 'Trash', 'href' => '/u/trash', 'icon_svg' => 'trash'],
        ],
    ],
    [
        'section' => null,
        'items' => [
            ['title' => 'Statistics', 'href' => '/u/statistics', 'icon_svg' => 'statistics'],
            ['title' => 'Referrals', 'href' => '/u/referrals', 'icon_svg' => 'referrals'],
            ['title' => 'Withdraw', 'href' => '/u/withdraw', 'icon_svg' => 'revenue'],
        ],
    ],
    [
        'section' => null,
        'items' => [
            ['title' => 'Support', 'href' => '/u/support', 'icon_svg' => 'support'],
        ],
    ],
    [
        'section' => 'Our services',
        'items' => [
            ['title' => 'Link4sub', 'href' => 'https://link4sub.com/?utm_source=safefileku', 'icon_img' => 'https://link4sub.com/images/1721055856.png'],
            ['title' => 'Vuotnhanh', 'href' => 'https://vuotnhanh.com/?utm_source=safefileku', 'icon_img' => 'https://vuotnhanh.com/images/app/logo.png'],
        ],
    ],
    [
        'section' => 'Partnership',
        'items' => [
            ['title' => 'SafelinkU', 'href' => 'https://safelinku.com/?utm_source=safefileku', 'icon_img' => 'https://safelinku.com/favicon.ico'],
        ],
    ],
];

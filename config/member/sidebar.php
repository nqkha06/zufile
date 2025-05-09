<?php

return [
    [
        'title' => 'member/partials/sidebar.dashboard',
        'url' => 'member.dashboard.index',
        'icon' => 'ki-outline ki-element-11 fs-2'
    ],
    [
        'title' => 'member/partials/sidebar.level_rate',
        'icon' => 'ki-outline ki-abstract-32 fs-2',
        'url' => 'member.payout_rates',

    ],
    [
        'title' => 'member/partials/sidebar.leaderboard',
        'icon' => 'ki-outline ki-ranking fs-2',
        'url' => 'member.leaderboard',
        'badge' => 'New',
        'badge_class' => 'badge badge-light-success badge-pill ms-3'

    ],
    [
        'title' => 'member/partials/sidebar.manage_links',
        'url' => 'admin.access.index',
        'icon' => 'ki-outline ki-abstract-49 fs-2',
        'children' => [
            [
                'title' => 'Sub unlock',
                'url' => 'member.stu_links',
                'active' => ['member.stu_links']

            ],
            [
                'title' => 'Ghi chú',
                'url' => 'member.note_links'
            ]
        ]
    ],
   
    // [
    //     'title' => 'Liên kết phổ biến',
    //     'icon' => 'ki-outline ki-share fs-2',
    //     'children' => [
    //         [
    //             'title' => 'Hôm nay',
    //             'url' => 'member.coming.soon'
    //         ],
    //         [
    //             'title' => '48h qua',
    //             'url' => 'member.coming.soon'
    //         ],
    //         [
    //             'title' => '7 ngày qua',
    //             'url' => 'member.coming.soon'
    //         ],
    //         [
    //             'title' => '28 ngày qua',
    //             'url' => 'member.coming.soon'
    //         ]
    //     ]
    // ],
    [
        'title' => 'member/partials/sidebar.referrals',
        'url' => 'member.referral',
        'icon' => 'ki-outline ki-people fs-2'
    ],
    [
        'title' => 'member/partials/sidebar.withdraw',
        'url' => 'member.withdraw.index',
        'icon' => 'ki-outline ki-wallet fs-2'
    ],
   
    [
        'title' => 'member/partials/sidebar.account',
        'icon' => 'ki-outline ki-abstract-13 fs-2',
        'children' => [
            [
                'title' => 'member/partials/sidebar.account_info',
                'url' => 'member.profile.index'
            ],
            [
                'title' => 'member/partials/sidebar.account_pay',
                'url' => 'member.payment.index'
            ],
            [
                'title' => 'member/partials/sidebar.account_pass',
                'url' => 'member.change_password'
            ],
        ]
    ],
    [
        'title' => 'member/partials/sidebar.support',
        'icon' => 'ki-outline ki-message-question fs-2',
        'url' => 'member.payout_rates',

    ],
    // Thêm các mục menu khác ở đây
];

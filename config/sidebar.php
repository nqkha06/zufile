<?php

return [
    [
        'title' => 'Trang chủ',
        'url' => 'admin.index',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>',
        'permission' => 'view_all_dashboard',
    ],
    [
        'title' => 'Trang tổng quan',
        'url' => 'admin.dashboard.index',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard"><path stroke="none"d="M0 0h24v24H0z"fill="none"/><path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M13.45 11.55l2.05 -2.05"/><path d="M6.4 20a9 9 0 1 1 11.2 0z"/></svg>',
        'permission' => 'view_all_dashboard',
    ],
    [
        'title' => 'Thống kê',
        'url' => 'admin.access.index',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-chart-bar"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M3 13a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path><path d="M15 9a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path><path d="M9 5a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z"></path><path d="M4 20h14"></path></svg>',
        'permission' => 'view_admin_access',
        'children' => [
            [
                'title' => 'Truy cập',
                'url' => 'admin.access.index',
            ],
            [
                'title' => 'Cấp độ',
                'url' => 'admin.stats.level',
            ]
        ]
    ],
    [
        'title' => 'Top BXH',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-medal"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 4v3m-4 -3v6m8 -6v6" /><path d="M12 18.5l-3 1.5l.5 -3.5l-2 -2l3 -.5l1.5 -3l1.5 3l3 .5l-2 2l.5 3.5z" /></svg>',
        'permission' => 'view_admin_ranking',
        'children' => [
            [
                'title' => 'Top users',
                'url' => 'admin.top-users.index'
            ],
            [
                'title' => 'Top links',
                'url' => 'admin.popular.stu'
            ]
        ]
    ],
    [
        'title' => 'Liên kết',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-link"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M9 15l6 -6"></path><path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path><path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"></path></svg>',
        'permission' => 'view_all_stu',
        'children' => [
            [
                'title' => 'STULinks',
                'url' => 'admin.stu.index'
            ],
            [
                'title' => 'NOTELinks',
                'url' => 'admin.note.index'
            ]
        ]
    ],
    [
        'title' => 'Hoá đơn',
        'url' => 'admin.invoices.index',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-invoice"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M14 3v4a1 1 0 0 0 1 1h4"></path><path d="M19 12v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-14a2 2 0 0 1 2 -2h7l5 5v4.25"></path></svg>',
        'permission' => 'view_all_dashboard',
    ],
    [
        'title' => 'Người dùng',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path><path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path></svg>',
        'permission' => 'view_all_dashboard',
        'children' => [
            [
                'title' => 'All Users',
                'url' => 'admin.users.index'
            ],
            [
                'title' => 'Create User',
                'url' => 'admin.users.create'
            ]
        ]
    ],
    [
        'title' => 'Phân quyền',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-circle-key"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M21 12a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z" /><path d="M12.5 11.5l-4 4l1.5 1.5" /><path d="M12 15l-1.5 -1.5" /></svg>',
        'permission' => 'view_all_dashboard',
        'children' => [
            [
                'title' => 'Vai trò',
                'url' => 'admin.roles.index'
            ],
            [
                'title' => 'Quyền',
                'url' => 'admin.permissions.index'
            ],
            [
                'title' => 'Nhóm quyền',
                'url' => 'admin.permission-groups.index'
            ]
        ]
    ],
    [
        'title' => 'Cấu hình',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-settings-2"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z"></path><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path></svg>',
        'permission' => 'view_all_dashboard',
        'children' => [
            [
                'title' => 'Hệ thống',
                'url' => 'admin.general.index'
            ],
            [
                'title' => 'PT Thanh toán',
                'url' => 'admin.payment-methods.index'
            ]
        ]
    ],
    [
        'title' => 'Quản lý cấp độ',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-settings-2"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z"></path><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path></svg>',
        'permission' => 'view_all_dashboard',
        'children' => [
            [
                'title' => 'SubUnlock',
                'url' => 'admin.levels.index'
            ],
            [
                'title' => 'Note',
                'url' => 'admin.note_levels.index'
            ]
        ]
    ],
    [
        'title' => 'Blog',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg"width="24"height="24"viewBox="0 0 24 24"fill="none"stroke="currentColor"stroke-width="2"stroke-linecap="round"stroke-linejoin="round"class="icon icon-tabler icons-tabler-outline icon-tabler-article"><path stroke="none"d="M0 0h24v24H0z"fill="none"></path><path d="M3 4m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path><path d="M7 8h10"></path><path d="M7 12h10"></path><path d="M7 16h10"></path></svg>',
        'permission' => 'view_all_dashboard',
        'children' => [
            [
                'title' => 'Category',
                'url' => 'admin.categories.index'
            ],
            [
                'title' => 'Posts',
                'url' => 'admin.posts.index'
            ],
            [
                'title' => 'Pages',
                'url' => 'admin.pages.index'
            ]
        ]
    ],
    [
        'title' => 'Widget',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-fidget-spinner"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 16v.01" /><path d="M6 16v.01" /><path d="M12 5v.01" /><path d="M12 12v.01" /><path d="M12 1a4 4 0 0 1 2.001 7.464l.001 .072a3.998 3.998 0 0 1 1.987 3.758l.22 .128a3.978 3.978 0 0 1 1.591 -.417l.2 -.005a4 4 0 1 1 -3.994 3.77l-.28 -.16c-.522 .25 -1.108 .39 -1.726 .39c-.619 0 -1.205 -.14 -1.728 -.391l-.279 .16l.007 .231a4 4 0 1 1 -2.212 -3.579l.222 -.129a3.998 3.998 0 0 1 1.988 -3.756l.002 -.071a4 4 0 0 1 -1.995 -3.265l-.005 -.2a4 4 0 0 1 4 -4z" /></svg>',
        'url' => 'admin.widgets.index',
        'permission' => 'view_all_dashboard',

    ],
    [
        'title' => 'Layout',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-layout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M4 13m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M14 4m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /></svg>',
        'permission' => 'view_all_dashboard',
        'children' => [
            [
                'title' => 'Quản lí Menu',
                'url' => 'admin.menus.index'
            ],
            // [
            //     'title' => 'Home (Landing Page)',
            //     'url' => 'admin.posts.index'
            // ],
            // [
            //     'title' => 'Blog - Home',
            //     'url' => 'admin.pages.index'
            // ],
            // [
            //     'title' => 'Blog - Post',
            //     'url' => 'admin.pages.index'
            // ],
            // [
            //     'title' => 'Blog - Page',
            //     'url' => 'admin.pages.index'
            // ]
        ]
    ],
    [
        'title' => 'Gửi Email',
        'icon' => '<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>',
        'url' => 'admin.send-emails.index',
        'permission' => 'view_all_dashboard',

    ],
    // Thêm các mục menu khác ở đây
];

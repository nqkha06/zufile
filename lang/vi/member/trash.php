<?php

return [
    'title' => 'Thùng rác',
    'subtitle' => 'Các tệp đã chuyển vào thùng rác sẽ bị xóa sau 30 ngày.',
    'tools' => [
        'restore' => 'Khôi phục',
        'delete' => 'Xóa vĩnh viễn'
    ],
    'table' => [
        'name' => 'Tên',
        'size' => 'Kích thước',
        'deleted_at' => 'Đã xóa lúc',
        'actions' => 'Hành động',
        'no_files' => 'Không có tệp nào trong thùng rác.',
        'expiry' => 'Sẽ bị xóa vào'
    ],
    'modal' => [
        'restore' => [
            'title' => 'Khôi phục tệp',
            'confirm' => 'Bạn có chắc chắn muốn khôi phục các tệp đã chọn không?',
            'cancel' => 'Hủy',
            'restore' => 'Khôi phục'
        ],
        'delete' => [
            'title' => 'Xóa vĩnh viễn',
            'confirm' => 'Bạn có chắc chắn muốn xóa vĩnh viễn các tệp đã chọn không?',
            'warning' => 'Hành động này không thể hoàn tác.',
            'cancel' => 'Hủy',
            'delete' => 'Xóa vĩnh viễn'
        ]
    ],
    'notifications' => [
        'restored' => 'Đã khôi phục tệp thành công.',
        'deleted' => 'Đã xóa vĩnh viễn tệp.'
    ]
];

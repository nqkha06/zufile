<?php

return [
    'title' => 'Trash',
    'subtitle' => 'Files moved to trash will be deleted after 30 days.',
    'tools' => [
        'restore' => 'Restore',
        'delete' => 'Delete Permanently'
    ],
    'table' => [
        'name' => 'Name',
        'size' => 'Size',
        'deleted_at' => 'Deleted At',
        'actions' => 'Actions',
        'no_files' => 'No files in trash.',
        'expiry' => 'Will be deleted on'
    ],
    'modal' => [
        'restore' => [
            'title' => 'Restore files',
            'confirm' => 'Are you sure you want to restore the selected files?',
            'cancel' => 'Cancel',
            'restore' => 'Restore'
        ],
        'delete' => [
            'title' => 'Delete permanently',
            'confirm' => 'Are you sure you want to permanently delete the selected files?',
            'warning' => 'This action cannot be undone.',
            'cancel' => 'Cancel',
            'delete' => 'Delete Permanently'
        ]
    ],
    'notifications' => [
        'restored' => 'Files restored successfully.',
        'deleted' => 'Files permanently deleted.'
    ]
];

<?php

return [
    'page_title' => 'Account settings',
    'account_info' => [
        'title' => 'Account Information',
        'description' => 'Settings relating to your account information.',
        'display_name' => 'Display name',
        'name_change_limit' => 'Can be changed once every 14 days.',
        'email_address' => 'Email address',
        'change_email' => 'Change email',
        'email_modal' => [
            'title' => 'Change email',
            'description' => "We'll send you a link to your current email address, in order to change it.",
            'continue' => 'Continue',
            'cancel' => 'Cancel',
            'sent_title' => 'Email has been sent',
            'sent_description' => "If you're not receiving emails, check your spam inbox. If you still don't find it you can request it again.",
            'close' => 'Close'
        ],
        'save' => 'Save'
    ],
    'download_options' => [
        'title' => 'Download page options',
        'description' => 'Options for settings on the download page for your files.',
        'related_files' => 'Display related file at download'
    ],
    'upload_options' => [
        'title' => 'Upload options',
        'description' => 'Options to customize such as default file settings when uploading etc.',
        'private_upload' => [
            'title' => 'Upload as private',
            'description' => 'Uploaded files will be set as private by default.'
        ]
    ],
    'password' => [
        'title' => 'Change password',
        'description' => 'Update your password associated with your account.',
        'current' => 'Current password',
        'new' => 'New password',
        'requirements' => 'Use 8 or more characters with at least a number or symbol'
    ],
    'linked_account' => [
        'title' => 'Linked account',
        'description' => 'Here are the external accounts that you have linked to/with your account. You can use them to authenticate.',
        'linked' => 'Linked',
        'unlink' => 'Unlink'
    ],
    'delete_account' => [
        'title' => 'Delete account',
        'description' => 'No longer want to use our service? You can delete your account here. This action is not reversible. All information related to this account will be deleted permanently.',
        'button' => 'Yes, delete my account',
        'modal' => [
            'title' => 'Are you sure you want to delete your account?',
            'description' => 'All files that have been uploaded cannot be restored, and usernames and emails cannot be used anymore.',
            'confirm' => 'Delete',
            'cancel' => 'Cancel'
        ]
    ]
];

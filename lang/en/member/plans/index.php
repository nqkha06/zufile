<?php

return [
    'title' => 'Subscription Plans',

    'your_subscription' => 'Your Subscription',

    'plan_expired_banner' => [
        'title' => 'Plan Expired',
        'text' => 'Your features are now limited to Free plan. You can renew your current plan, upgrade to a new plan, or switch to Free plan.',
    ],

    'plan_price' => 'Plan Price',
    'ends_on' => 'Ends on',
    'expired_on' => 'Expired on',
    'storage_used' => 'Storage Used',
    'current_limits' => 'Current Limits',
    'free_plan_limits' => 'Free Plan Limits',
    'unlimited' => 'Unlimited',

    'alerts' => [
        'expired' => [
            'title' => 'Plan Expired!',
            'message' => 'Your plan expired :days days ago. Renew to continue using premium features.',
        ],
        'expiring_soon' => [
            'title' => 'Plan Expiring Soon!',
            'message' => 'Your plan expires in :days days. Consider renewing to avoid interruption.',
        ],
    ],

    'quick_actions' => [
        'title' => 'Quick Actions',
        'plan_options' => 'Plan Options',
    ],

    'buttons' => [
        'renew_current' => 'Renew Current Plan',
        'renew' => 'Renew Plan',
        'current_plan' => 'Current Plan',
        'downgrade_to_free' => 'Downgrade to Free',
        'downgrade' => 'Downgrade Plan',
        'upgrade' => 'Upgrade Plan',
        'choose' => 'Choose Plan',
        'cancel' => 'Cancel',
        'yes_switch_to_free' => 'Yes, Switch to Free',
        'yes_downgrade' => 'Yes, Downgrade',
    ],

    'available_plans' => 'Available Plans',

    'badges' => [
        'current' => 'Current',
    ],

    'price' => [
        'free' => 'Free',
        'per_month' => '/month',
    ],

    'features' => [
        'storage_suffix' => 'of storage',
        'per_file' => 'per file',
        'file_stored_forever' => 'File stored forever',
        'file_stored_days' => 'File stored :days days no activity',
        'ads_reduced' => 'Ads reduced',
    ],

    'modals' => [
        'upgrade' => [
            'payment_method_30' => 'Payment method (30 days)',
        ],
        'downgrade' => [
            'title_free' => 'Downgrade to Free Plan',
            'title' => 'Downgrade to :plan',
            'warning' => 'Warning',
            'free_warning' => 'Downgrading to the free plan will immediately deactivate your current plan. You will lose access to premium features.',
            'paid_warning' => 'Downgrading will change your plan to :plan ($:price/month). Some features may be limited.',
            'confirm' => 'Are you sure you want to downgrade?',
        ],
        'renew' => [
            'title' => 'Renew :plan',
            'plan_extension' => 'Plan Extension',
            'expired_message' => 'Your plan expired :days days ago. Renewal will start from today and last for 30 days.',
            'active_message' => 'Your plan expires :date. Renewal will extend your plan by 30 days from the current expiration date.',
            'choose_payment' => 'Choose payment method (30 days - $:price)',
        ],
    ],

    'payment_methods' => [
        'balance' => 'Balance (:balance)',
        'balance_label' => 'Balance :balance',
    ],

    'no_active_plan' => [
        'title' => 'No Active Plan',
        'message' => "You don't have an active plan. Choose a plan below to get started!",
    ],

    'plan_options_hint' => 'Choose to renew your current plan, upgrade to a different plan, or switch to the free plan.',
];

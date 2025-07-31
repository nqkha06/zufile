# Plan Management System Refactor

This document describes the refactored plan management system that uses direct columns on the `users` table instead of a pivot table.

## Database Changes

### New Columns in `users` table:
- `plan_id` (unsignedBigInteger, foreign key to plans.id, default: 1)
- `plan_expires_at` (timestamp, nullable)

### Logic:
- Every user has exactly one plan (referenced by `plan_id`)
- Default plan is Free Plan (ID = 1)
- If `plan_expires_at` is NULL → plan never expires (Free/Lifetime plans)
- If `plan_expires_at` < now() → plan is expired, user should be downgraded to Free
- When expired plans are detected, users are automatically moved to Free plan

## Key Changes

### User Model Methods:
- `plan()` - Relationship to the current plan
- `getActivePlan()` - Returns active plan or Free if expired
- `hasActivePlan()` - Check if user has non-expired paid plan
- `hasPlanExpired()` - Check if current plan is expired
- `isPlanExpiringSoon($days = 7)` - Check if plan expires soon
- `getDaysUntilExpiration()` - Get days until expiration
- `getPlanStatus()` - Get formatted status string
- `assignPlan($planId, $durationInDays)` - Assign new plan
- `renewPlan($durationInDays)` - Extend current plan
- `downgradeToFreePlan()` - Move to free plan
- `handleExpiredPlan()` - Auto-downgrade if expired
- `isOnFreePlan()` - Check if on free plan

### Plan Model Changes:
- `users()` - Direct relationship to users with this plan
- `getActiveUsersCountAttribute()` - Count of non-expired users

### Service Layer:
- `PlanService` completely rewritten to work with new structure
- All methods now return boolean instead of PlanUser objects
- Simplified logic without pivot table complexity

### Controller Updates:
- `PlanController` updated to work with new User methods
- Automatic expired plan handling on page load

### View Updates:
- Updated `plans/index.blade.php` to use new structure
- Fixed all references to use User methods instead of PlanUser

## Automatic Expiration Handling

### Middleware:
- `HandleExpiredPlan` middleware automatically downgrades expired users
- Shows warning message when plan expires

### Console Command:
- `php artisan plans:process-expired` - Process all expired plans
- `php artisan plans:process-expired --dry-run` - See what would be processed

### Migration:
- `add_plan_columns_to_users_table` - Adds new columns
- `migrate_plan_user_data_to_users` - Migrates existing data from plan_user table

## Usage Examples

### Check if user can upload file:
```php
if ($user->canUploadFile($fileSize)) {
    // Allow upload
}
```

### Get user's current plan:
```php
$plan = $user->getActivePlan(); // Always returns a plan (Free if expired)
$displayPlan = $user->getDisplayPlan(); // Shows actual plan even if expired
```

### Assign a plan:
```php
$user->assignPlan(2, 30); // Plan ID 2 for 30 days
```

### Renew current plan:
```php
$user->renewPlan(30); // Extend by 30 days
```

### Check plan status:
```php
if ($user->hasPlanExpired()) {
    // Handle expired plan
}

if ($user->isPlanExpiringSoon()) {
    // Show renewal reminder
}
```

## Benefits of New System

1. **Simpler Architecture**: Direct foreign key relationship instead of complex pivot table
2. **Better Performance**: Fewer joins required for plan checks
3. **Automatic Cleanup**: Expired plans are automatically handled
4. **Cleaner Code**: More intuitive methods on User model
5. **Easier Queries**: Simple WHERE clauses on users table
6. **Data Integrity**: Always exactly one plan per user

## Migration Guide

1. Run migrations to add new columns
2. Run data migration to copy from plan_user table
3. Update any custom code to use new User methods
4. Test thoroughly before removing plan_user table
5. Add HandleExpiredPlan middleware to HTTP kernel
6. Set up cron job for `plans:process-expired` command

## Notes

- Free plan (ID = 1) must exist in database
- plan_expires_at = NULL means never expires
- Expired plans are automatically detected and handled
- All plan logic is now centralized in User model
- PlanUser model and plan_user table are no longer needed

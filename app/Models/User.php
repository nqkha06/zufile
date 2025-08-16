<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Set default free plan if not specified
            if (!$user->plan_id) {
                $user->plan_id = 1; // Free plan ID
                $user->plan_expires_at = null; // Free plan never expires
            }
        });
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
        'used_storage',
        'referred_by',
        'plan_id',
        'plan_expires_at'
    ];
    protected $hidden = [
        'password',
        'remember_token'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'plan_expires_at' => 'datetime',
        'used_storage' => 'integer',
        'balance' => 'float',

    ];

    public function settings()
    {
        return $this->hasMany(UserSetting::class);
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }
    public function paymentMethod()
    {
        return $this->hasOne(UserPaymentMethod::class);
    }
    public function paymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'user_payment_methods', 'user_id', 'payment_method_id')
                    ->withPivot('details')
                    ->withTimestamps();
    }
    public function userPaymentMethod()
    {
        return $this->hasMany(UserPaymentMethod::class, 'user_id');
    }
    public function withdraw()
    {
        return $this->hasMany(UserWithdraw::class);
    }
    public function invoices()
    {
        return $this->hasMany(UserWithdraw::class);
    }


    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }
    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function downloadAccesses()
    {
        return $this->hasMany(DownloadAccesses::class, 'user_id');
    }

    public function getUsedStorageFormattedAttribute()
    {
        $size = $this->used_storage;

        if ($size >= 1073741824) {
            return number_format($size / 1073741824, 2) . ' GB';
        } elseif ($size >= 1048576) {
            return number_format($size / 1048576, 2) . ' MB';
        } elseif ($size >= 1024) {
            return number_format($size / 1024, 2) . ' KB';
        } else {
            return $size . ' B';
        }
    }

    /**
     * Relationship with the user's current plan
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    /**
     * Get the user's effective plan for permissions/limits
     * If plan is expired, use free plan limits but keep display plan
     */
    public function getEffectivePlan()
    {
        if ($this->hasPlanExpired()) {
            return Plan::find(1); // Use free plan limits
        }

        return $this->plan ?? Plan::find(1);
    }

    /**
     * Get the user's current active plan (for backwards compatibility)
     * Now returns effective plan for limits
     */
    public function getActivePlan()
    {
        return $this->getEffectivePlan();
    }

    /**
     * Check if user has an active (non-expired) plan
     */
    public function hasActivePlan(): bool
    {
        return $this->plan_id &&
               $this->plan_id !== 1 &&
               !$this->hasPlanExpired();
    }

    /**
     * Check if user's plan is expired
     */
    public function hasPlanExpired(): bool
    {
        // If no expiration date (free/lifetime plans), never expired
        if (!$this->plan_expires_at) {
            return false;
        }

        return $this->plan_expires_at->isPast();
    }

    /**
     * Check if user's plan is expiring soon
     */
    public function isPlanExpiringSoon(int $days = 7): bool
    {
        if (!$this->plan_expires_at || $this->plan_expires_at->isPast()) {
            return false;
        }

        return now()->diffInDays($this->plan_expires_at) <= $days;
    }


    /**
     * Get days until expiration (negative if expired)
     */
    public function getDaysUntilExpiration(): int
    {
        if (!$this->plan_expires_at) {
            return -1; // Never expires
        }

        return (int) now()->diffInDays($this->plan_expires_at, false);
    }

    /**
     * Get current plan status
     */
    public function getPlanStatus(): string
    {
        if (!$this->plan_id || $this->plan_id === 1) {
            return 'Free Plan';
        }

        if ($this->hasPlanExpired()) {
            $daysOverdue = abs($this->getDaysUntilExpiration());
            return "Expired {$daysOverdue} day" . ($daysOverdue > 1 ? 's' : '') . " ago";
        }

        if ($this->isPlanExpiringSoon()) {
            $daysLeft = $this->getDaysUntilExpiration();
            return "Expires in {$daysLeft} day" . ($daysLeft > 1 ? 's' : '');
        }

        return 'Active';
    }

    /**
     * Get formatted expiration status
     */
    public function getExpirationStatus(): string
    {
        return $this->getPlanStatus();
    }

    /**
     * Check if user can perform action based on plan limits
     */
    public function canUploadFile(int $fileSize): bool
    {
        $plan = $this->getActivePlan();

        // Check storage limit
        if (($this->used_storage + $fileSize) > $plan->storage_limit) {
            return false;
        }

        // Check file size limit
        if ($fileSize > $plan->file_size_limit) {
            return false;
        }

        return true;
    }

    /**
     * Get storage usage percentage
     */
    public function getStorageUsagePercentage(): float
    {
        $plan = $this->getActivePlan();
        if ($plan->storage_limit == 0) {
            return 0;
        }

        return min(100, ($this->used_storage / $plan->storage_limit) * 100);
    }

    /**
     * Get effective plan for display (shows actual plan even if expired)
     */
    public function getDisplayPlan()
    {
        return $this->plan ?? Plan::find(1);
    }

    /**
     * Get effective plan name for display
     */
    public function getDisplayPlanName()
    {
        $plan = $this->getDisplayPlan();

        if ($this->hasPlanExpired() && $this->plan_id !== 1) {
            return $plan->name . ' (Expired)';
        }

        return $plan->name;
    }

    /**
     * Upgrade/change user's plan
     */
    public function assignPlan(int $planId, int $durationInDays = 30): void
    {
        $plan = Plan::findOrFail($planId);

        $this->plan_id = $planId;

        if ($plan->isFree()) {
            // Free plan never expires
            $this->plan_expires_at = null;
        } else {
            // Paid plan expires after specified duration
            $this->plan_expires_at = now()->addDays($durationInDays);
        }

        $this->save();
    }

    /**
     * Renew current plan by extending expiration date
     */
    public function renewPlan(int $durationInDays = 30): void
    {
        if (!$this->plan_id || $this->plan_id === 1) {
            throw new \Exception('Cannot renew free plan');
        }

        // Calculate new expiration date
        $baseDate = $this->plan_expires_at && $this->plan_expires_at->isFuture()
            ? $this->plan_expires_at
            : now();

        $this->plan_expires_at = $baseDate->addDays($durationInDays);
        $this->save();
    }

    /**
     * Downgrade to free plan
     */
    public function downgradeToFreePlan(): void
    {
        $this->plan_id = 1; // Free plan ID
        $this->plan_expires_at = null; // Free plan never expires
        $this->save();
    }

    /**
     * Check if user is currently on free plan
     */
    public function isOnFreePlan(): bool
    {
        return $this->plan_id === 1 || $this->plan_id === null;
    }

    /**
     * Check expired plans status (does not auto-downgrade)
     * This method can be used to log or track expired plans
     */
    public function handleExpiredPlan(): void
    {
        // Just check the status, don't auto-downgrade anymore
        // User keeps their plan but with free plan limitations
        if ($this->hasPlanExpired()) {
            // Optionally log the expired plan
            \Illuminate\Support\Facades\Log::info('User has expired plan', [
                'user_id' => $this->id,
                'plan_id' => $this->plan_id,
                'expired_at' => $this->plan_expires_at
            ]);
        }
    }
}

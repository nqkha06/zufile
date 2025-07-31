<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanUser extends Model
{
    use HasFactory;

    protected $table = 'plan_user';

    protected $fillable = [
        'user_id',
        'plan_id',
        'started_at',
        'expires_at',
        'price_paid',
        'is_active',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
        'price_paid' => 'decimal:2',
    ];

    public $timestamps = false;

    // Quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với Plan
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Check if the plan is expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Check if the plan is expiring soon (within X days)
     */
    public function isExpiringSoon(int $days = 7): bool
    {
        if (!$this->expires_at) {
            return false;
        }

        return $this->expires_at->isFuture() &&
               $this->expires_at->diffInDays(now()) <= $days;
    }

    /**
     * Get days until expiration (negative if expired)
     */
    public function getDaysUntilExpiration(): int
    {
        if (!$this->expires_at) {
            return -1;
        }

        return (int) now()->diffInDays($this->expires_at, false);
    }

    /**
     * Get formatted expiration status
     */
    public function getExpirationStatus(): string
    {
        if (!$this->is_active) {
            return 'Inactive';
        }

        if ($this->isExpired()) {
            $daysOverdue = abs($this->getDaysUntilExpiration());
            return "Expired {$daysOverdue} day" . ($daysOverdue > 1 ? 's' : '') . " ago";
        }

        if ($this->isExpiringSoon()) {
            $daysLeft = $this->getDaysUntilExpiration();
            return "Expires in {$daysLeft} day" . ($daysLeft > 1 ? 's' : '');
        }

        return 'Active';
    }

    /**
     * Scope for active plans
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for expired plans
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    /**
     * Scope for expiring soon plans
     */
    public function scopeExpiringSoon($query, int $days = 7)
    {
        return $query->where('expires_at', '>', now())
                    ->where('expires_at', '<=', now()->addDays($days));
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plans';

    protected $fillable = [
        'name',
        'price',
        'storage_limit',
        'file_size_limit',
        'file_keep_forever',
        'file_keep_days',
        'ads_reduced',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'storage_limit' => 'integer',
        'file_size_limit' => 'integer',
        'file_keep_days' => 'integer',
        'file_keep_forever' => 'boolean',
        'ads_reduced' => 'boolean',
    ];

    /**
     * Relationship with users who have this plan
     */
    public function users()
    {
        return $this->hasMany(User::class, 'plan_id');
    }

    /**
     * Get active users count for this plan (non-expired)
     */
    public function getActiveUsersCountAttribute(): int
    {
        return $this->users()
            ->where(function ($query) {
                $query->whereNull('plan_expires_at')
                      ->orWhere('plan_expires_at', '>', now());
            })
            ->count();
    }

    /**
     * Check if this is a free plan
     */
    public function isFree(): bool
    {
        return $this->price == 0;
    }

    /**
     * Get formatted storage limit
     */
    public function getFormattedStorageLimitAttribute(): string
    {
        if ($this->storage_limit >= 1073741824) {
            return number_format($this->storage_limit / 1073741824, 1) . ' GB';
        } elseif ($this->storage_limit >= 1048576) {
            return number_format($this->storage_limit / 1048576, 1) . ' MB';
        } elseif ($this->storage_limit >= 1024) {
            return number_format($this->storage_limit / 1024, 1) . ' KB';
        }
        return $this->storage_limit . ' B';
    }

    /**
     * Get formatted file size limit
     */
    public function getFormattedFileSizeLimitAttribute(): string
    {
        if ($this->file_size_limit >= 1048576) {
            return number_format($this->file_size_limit / 1048576, 1) . ' MB';
        } elseif ($this->file_size_limit >= 1024) {
            return number_format($this->file_size_limit / 1024, 1) . ' KB';
        }
        return $this->file_size_limit . ' B';
    }

    /**
     * Scope for non-free plans
     */
    public function scopePaid($query)
    {
        return $query->where('price', '>', 0);
    }
}

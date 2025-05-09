<?php

namespace App\Enums;

enum InvoiceStatusEnum: string
{
    case PENDING = 'pending';          
    case REVIEWED = 'approved';      
    case COMPLETED = 'completed';      
    case FAILED = 'failed';        
    case ON_HOLD = 'on_hold';        
    case REJECTED = 'rejected'; 
    case CANCELLED = 'cancelled';      
    case REFUNDED = 'refunded';    

    public function isPending(): bool
    {
        return $this === self::PENDING;
    }

    public function isReviewed(): bool
    {
        return $this === self::REVIEWED;
    }

    public function isCompleted(): bool
    {
        return $this === self::COMPLETED;
    }

    public function isFailed(): bool
    {
        return $this === self::FAILED;
    }
    public function isCancelled(): bool
    {
        return $this === self::CANCELLED;
    }

    public function isOnHold(): bool
    {
        return $this === self::ON_HOLD;
    }

    public function isRefunded(): bool
    {
        return $this === self::REFUNDED;
    }

    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('withdraw.pending'),
            self::REVIEWED => __('withdraw.watched'),
            self::COMPLETED => __('withdraw.success'),
            self::FAILED => __('withdraw.refuse'),
            self::ON_HOLD => 'Liên hệ',
            self::REJECTED => 'Từ chối',
            self::CANCELLED => 'Đã huỷ',
            self::REFUNDED => 'Hoàn tiền lại',
        };
    }
    
    public function toHtml(): string
    {
        return match ($this) {
            self::PENDING => '<span class="badge bg-yellow text-yellow-fg">Đang xử lý</span>',
            self::REVIEWED => '<span class="badge bg-blue text-blue-fg">Đã xem xét</span>',
            self::COMPLETED => '<span class="badge bg-green text-green-fg">Thành công</span>',
            self::FAILED => '<span class="badge bg-red text-red-fg">Từ chối</span>',
            self::ON_HOLD => '<span class="badge bg-dark text-dark-fg">Liên hệ</span>',
            self::REJECTED => '<span class="badge bg-danger">Từ chối</span>',
            self::REFUNDED => '<span class="badge bg-info">Hoàn tiền lại</span>',
        };
    }
}

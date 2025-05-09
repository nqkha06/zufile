<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => __('Kích hoạt'),
            self::INACTIVE => __('Chưa kích hoạt'),
            self::SUSPENDED => __('Bị cấm'),
            default => __('Unknown'),
        };
    }

    public function html(): string
    {
        return match ($this) {
            self::ACTIVE => '<span class="badge bg-green text-green-fg">'.__('Kích hoạt').'</span>',
            self::INACTIVE => '<span class="badge bg-blue text-blue-fg">'.__('Chưa kích hoạt').'</span>',
            self::SUSPENDED => '<span class="badge bg-yellow text-yellow-fg">'.__('Bị cấm').'</span>',
            default => '<span class="badge">'.__('Unknown').'</span>',
        };
    }
}

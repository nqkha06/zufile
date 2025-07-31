<?php

namespace App\Enums\ApiToken;

enum StatusEnum: int
{
    case ACTIVE = 1;
    case INACTIVE = 2;
    case DELETED = 3;

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'enums.api_type.status.active',
            self::INACTIVE => 'enums.api_type.status.inactive',
            self::DELETED => 'enums.api_type.status.deleted',
        };
    }

    public static function fromValue(int|string|null $value): ?self
    {
        return match ((int) $value) {
            1 => self::ACTIVE,
            2 => self::INACTIVE,
            3 => self::DELETED,
            default => null,
        };
    }
}

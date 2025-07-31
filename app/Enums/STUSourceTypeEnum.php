<?php

namespace App\Enums;

enum STUSourceTypeEnum: int
{
    case WEB = 1;
    case API = 2;
    case QUICK = 3;
    case SCRIPT = 4;

    public function label(): string
    {
        return match ($this) {
            self::WEB => 'stu.enums.web',
            self::API => 'stu.enums.api',
            self::QUICK => 'stu.enums.quick',
            self::SCRIPT => 'stu.enums.script',
        };
    }

    public static function fromValue(int|string|null $value): ?self
    {
        return match ((int) $value) {
            1 => self::WEB,
            2 => self::API,
            3 => self::QUICK,
            4 => self::SCRIPT,
            default => null,
        };
    }
}

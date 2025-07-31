<?php

namespace App\Enums\ApiToken;

enum APITypeEnum: int
{
    case STU = 1;
    case NOTE = 2;

    public function label(): string
    {
        return match ($this) {
            self::STU => 'enums.api_type.stu',
            self::NOTE => 'enums.api_type.note',
        };
    }

    public static function fromValue(int|string|null $value): ?self
    {
        return match ((int) $value) {
            1 => self::STU,
            2 => self::NOTE,
            default => null,
        };
    }
}

<?php

namespace App\Enums;

enum Role : string
{
    case ADMIN = 'admin';

    case WORKER = 'worker';

    public static function values(): array
    {
        return array_map(fn ($enum) => $enum->value, self::cases());
    }

    public function getName(): string
    {
        return $this->name;
    }
}

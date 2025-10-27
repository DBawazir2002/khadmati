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


    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'مدير',
            self::WORKER => 'مقدم الخدمة',
        };
    }

    public static function findFrom($role): bool
    {
        return match ($role) {
            self::ADMIN->value => true,
            self::WORKER->value => true,
            default => false
        };
    }
}

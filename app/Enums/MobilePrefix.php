<?php

namespace App\Enums;

enum MobilePrefix : int
{
    case PREFIX_Y = 70;
    case PREFIX_SABAFON = 71;
    case PREFIX_YOU = 73;
    case PREFIX_YEMEN_MOBILE = 77;

    public static function values(): array
    {
        return array_map(fn ($enum) => $enum->value, self::cases());
    }

//    public function getLabel(): ?string
//    {
//        return match ($this) {
//            self::PREFIX_Y => 'واي',
//            self::PREFIX_SABAFON => 'سبأفون',
//            self::PREFIX_YOU => 'اليمنية العمانية المتحدة للإتصالات (يو)',
//            self::PREFIX_YEMEN_MOBILE => 'يمن موبايل',
//        };
//    }
}

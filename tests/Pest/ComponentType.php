<?php

declare(strict_types=1);

namespace Tests\Pest;

enum ComponentType : int
{
    case REGULAR_CLASS = 1;

    case INTERFACE = 2;

    case ATTRIBUTE = 4;

    case TRAIT = 8;

    case ENUM = 16;

    case EXCEPTION = 32;

    public static function any(): int
    {
        return array_reduce(self::cases(), fn($carry, $case) => $carry | $case->value, 0);
    }

    public static function combine(ComponentType ...$types): int
    {
        return array_reduce($types, fn($carry, $type) => $carry | $type->value, 0);
    }

    public static function hasType(int $allowedTypes, ComponentType $type): bool
    {
        return ($allowedTypes & $type->value) === $type->value;
    }

    public static function validate(int $types): bool
    {
        return ($types & self::any()) === $types;
    }
}

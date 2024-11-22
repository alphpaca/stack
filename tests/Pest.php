<?php

use Pest\Arch\Contracts\ArchExpectation;
use Pest\Arch\Expectations\Targeted;
use Pest\Arch\Support\FileLineFinder;
use PHPUnit\Architecture\Elements\ObjectDescription;
use Tests\Pest\ComponentType;

pest()
    ->group('core')
    ->in(dirname(__DIR__) . '/components/core/tests')
;

expect()->extend('toBeOneOf', function (ComponentType ...$allowedTypes): ArchExpectation {
    $isAttribute = function (string $className): bool {
        $reflectedClass = new \ReflectionClass($className);
        $foundAttributes = $reflectedClass->getAttributes(\Attribute::class, \ReflectionAttribute::IS_INSTANCEOF);

        return count($foundAttributes) > 0;
    };

    return Targeted::make(
        $this,
        function (ObjectDescription $object) use ($isAttribute, $allowedTypes): bool {
            $type = match(true) {
                interface_exists($object->name) => ComponentType::INTERFACE,
                enum_exists($object->name) => ComponentType::ENUM,
                class_exists($object->name) && is_a($object->name, Throwable::class, true) => ComponentType::EXCEPTION,
                class_exists($object->name) && $isAttribute($object->name) => ComponentType::ATTRIBUTE,
                default => ComponentType::REGULAR_CLASS,
            };

            return ComponentType::hasType(ComponentType::combine(...$allowedTypes), $type);
        },
        'be one of ' . implode(', ', array_map(fn (ComponentType $type): string => $type->name, $allowedTypes)),
        FileLineFinder::where(fn (string $line): bool => str_contains($line, 'class')),
    );
});

<?php

use Tests\Pest\ComponentType;

arch('(Resource Component): Allow only classes and traits')
    ->expect('Alphpaca\Component\Resource')
    ->toBeOneOf(ComponentType::REGULAR_CLASS, ComponentType::TRAIT)
;

arch('(Resource Contracts): Allow only attributes, enums, interfaces and exceptions')
    ->expect('Alphpaca\Contracts\Resource')
    ->toBeOneOf(ComponentType::ATTRIBUTE, ComponentType::ENUM, ComponentType::INTERFACE, ComponentType::EXCEPTION)
;

arch('(Resource Contracts): Force PHP code documenting')
    ->expect('Alphpaca\Contracts\Resource')
    ->toHaveMethodsDocumented()
    ->and('Alphpaca\Contracts\Resource')
    ->toHavePropertiesDocumented()
;

<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Configuration\ECSConfigBuilder;

$config = require __DIR__ . '/tools/coding-standard/vendor/alphpaca/coding-standard/ecs.php';
assert($config instanceof ECSConfigBuilder);

return $config
//    ->withPaths([
//        __DIR__ . '/components',
//    ])
;

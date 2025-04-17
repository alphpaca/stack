<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\Config\MBConfig;

return static function (MBConfig $mbConfig): void {
    $mbConfig->packageDirectories([
        // components
        __DIR__ . '/components/resource',

        // contracts
        __DIR__ . '/contracts/resource',
    ]);
};

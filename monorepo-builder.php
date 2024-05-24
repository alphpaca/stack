<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\ComposerJsonManipulator\ValueObject\ComposerJsonSection;
use Symplify\MonorepoBuilder\Config\MBConfig;

return static function (MBConfig $mbConfig): void {
    $mbConfig->packageDirectories([
        __DIR__ . '/contracts',
        __DIR__ . '/symfony',
    ]);

    $mbConfig->dataToAppend([
        ComposerJsonSection::REQUIRE_DEV => [
            'friendsofphp/php-cs-fixer' => '^3.57',
            'symplify/monorepo-builder' => '^11.2',
        ],
        ComposerJsonSection::CONFIG => [
            'sort-packages' => true,
        ],
    ]);
};

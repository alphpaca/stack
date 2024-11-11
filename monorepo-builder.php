<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\ComposerJsonManipulator\ValueObject\ComposerJsonSection;
use Symplify\MonorepoBuilder\Config\MBConfig;

return static function (MBConfig $mbConfig): void {
    $mbConfig->packageDirectories([
        __DIR__ . '/components',
        __DIR__ . '/contracts',
    ]);

    $mbConfig->dataToAppend([
        ComposerJsonSection::REQUIRE_DEV => [
            'alphpaca/monocle-constraint' => '^0.1.2',
            'captainhook/captainhook' => '^5.23',
            'friendsofphp/php-cs-fixer' => '^3.57',
            'mockery/mockery' => '^1.6',
            'pestphp/pest' => '^3.2',
            'phpstan/phpstan' => '^2.0',
            'shipmonk/composer-dependency-analyser' => '^1.5',
            'symplify/monorepo-builder' => '^11.2',
        ],
        ComposerJsonSection::CONFIG => [
            'sort-packages' => true,
        ],
        ComposerJsonSection::AUTOLOAD_DEV => [
            'psr-4' => [
                'Tests\\' => 'tests',
            ],
        ],
    ]);
};

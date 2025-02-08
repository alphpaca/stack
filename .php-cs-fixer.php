<?php

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

$finder = (new PhpCsFixer\Finder())
    ->in([
        __DIR__ . '/components/resource/src',
        __DIR__ . '/contracts/resource/src',
    ])
;

return (new PhpCsFixer\Config())
    ->setParallelConfig(ParallelConfigFactory::detect())
    ->setRules([
        '@PHP83Migration' => true,
        '@PSR12' => true,
        '@Symfony' => true,
        'header_comment' => [
            'header' => <<<'EOF'
                This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).

                (c) Jacob Tobiasz <jacob@alphpaca.io>

            This source file is subject to the Apache License 2.0 that is bundled
            with this source code in the file LICENSE.
            EOF,
        ],
        'phpdoc_types' => false,
    ])
    ->setFinder($finder)
;

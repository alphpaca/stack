<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Filesystem\FileExistenceChecker;

describe('File Existence Checker', function () {
    covers(FileExistenceChecker::class);

    $checker = new FileExistenceChecker();

    it('returns if a file exists', function () use ($checker) {
        expect($checker->exists(__DIR__ . '/DataFixtures/file.txt'))->toBeTrue()
            ->and($checker->exists(__DIR__ . '/DataFixtures/does_not_exist.txt'))->toBeFalse()
        ;
    });
});

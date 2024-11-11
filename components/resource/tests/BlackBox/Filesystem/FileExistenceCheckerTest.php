<?php

declare(strict_types=1);

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

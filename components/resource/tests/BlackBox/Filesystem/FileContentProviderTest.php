<?php

declare(strict_types=1);

use Alphpaca\Component\Resource\Filesystem\FileContentProvider;
use Alphpaca\Component\Resource\Filesystem\FileExistenceChecker;
use Alphpaca\Contracts\Resource\Filesystem\Exception\FileCannotBeFoundException;

describe('File Content Provider', function (): void {
    it('provides a given file content', function () {
        $provider = new FileContentProvider(
            new FileExistenceChecker(),
        );

        $path = __DIR__ . '/DataFixtures/file.txt';

        $result = $provider->provide($path);

        expect($result)->toBe('hello :D' . PHP_EOL);
    });

    it('throws an exception if the file does not exist', function () use ($provider) {
        $provider = new FileContentProvider(
            new FileExistenceChecker(),
        );

        $path = '/app/i-do-not-exist.txt';

        $provider->provide($path);
    })->throws(FileCannotBeFoundException::class, 'File "/app/i-do-not-exist.txt" does not exist.');
});

<?php declare(strict_types=1);

/*
 * This file is part of Alphpaca Stack (https://github.com/alphpaca/stack).
 *
 * (c) Jacob Tobiasz <jacob@alphpaca.io>
 *
 * This source file is subject to the Apache License 2.0 that is bundled
 * with this source code in the file LICENSE.
 */

use Alphpaca\Component\Resource\Filesystem\FileContentProvider;
use Alphpaca\Component\Resource\Filesystem\FileExistenceChecker;
use Alphpaca\Contracts\Resource\Filesystem\Exception\FileCannotBeFoundException;
use Alphpaca\Contracts\Resource\Filesystem\Exception\FileCannotBeReadException;

describe('File Content Provider', function (): void {
    covers(FileContentProvider::class);

    it('provides a given file content', function () {
        $path = __DIR__ . '/DataFixtures/file.txt';

        $provider = new FileContentProvider(new FileExistenceChecker());
        $result = $provider->provide($path);

        expect($result)->toBe('hello :D' . PHP_EOL);
    });

    it('throws an exception if the file does not exist', function () {
        $path = '/app/i-do-not-exist.txt';

        $provider = new FileContentProvider(new FileExistenceChecker());
        $provider->provide($path);
    })->throws(FileCannotBeFoundException::class, 'File "/app/i-do-not-exist.txt" does not exist.');

    it('throws an exception if the file cannot be read', function () {
        $path = __DIR__ . '/DataFixtures/not_readable_file.txt';
        chmod($path, 000);

        $provider = new FileContentProvider(new FileExistenceChecker());
        $provider->provide($path);
    })->throws(
        FileCannotBeReadException::class,
        sprintf('File "%s" cannot be read.', __DIR__ . '/DataFixtures/not_readable_file.txt'),
    )->after(fn () => chmod(__DIR__ . '/DataFixtures/not_readable_file.txt', 0644));
});
